<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Transaction;
use App\Branch;
use App\PolicySeries;
use App\Insuran_price;
use App\Setting;
use App\Rules\AgeRestriction1;
use DB;
use PDF;
use App\Relationship;
use App\Rules\AlphabetStringOnly;

class CoiMController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.coi_number', 't.insured_name', 't.posted', 't.id', 't.beneficiary', 't.relationship'])
            ->where('t.type', 'M')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_m.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $relationships = Relationship::where('status', true)->get();
        $datenow = date('Y-m-d');
        return view('transactions.coi_m.create', compact('branch', 'datenow', 'relationships'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'contact_number' => 'required|digits:11',
            'email' => 'required|email:rfc,dns',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'relationship' => 'required',
            'units' => 'required|numeric|between:1,1',
            // 'dateofbirth' => ['required', new AgeRestriction1],
            'dateofbirth' => 'required',
        ]);
        
        $price_id = 6;
        $type_string = 'mediphone';

        try {
            $transaction_policy_number = collect(session('systemSettings'))->where('name', $type_string)->pluck('value')->first();
            $transaction_price = collect(session('insurancePrices'))->where('id', $price_id)->pluck('price')->first();

            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->policy_number = $transaction_policy_number;
            $transaction->price = $transaction_price;
            $transaction->units = $request->units;
            $transaction->contact_number = $request->contact_number;
            $transaction->email = $request->email;
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->type = 'M';
            $transaction->status = 'active';
            $transaction->posted = 0;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_m.create')->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_m.show', Crypt::encrypt($transaction->id));
    }

    public function show($id)
    {
        try {

            // $branch = Branch::find(auth()->user()->branch_id);
            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_m.index');

        }

        return view('transactions.coi_m.show', compact('id', 'transaction', 'relationships'));
    }

    public function edit($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();
        
        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_m.index');

        }

        return view('transactions.coi_m.edit' ,compact('transaction', 'relationships'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'contact_number' => 'required|digits:11',
            'email' => 'required|email:rfc,dns',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'relationship' => 'required',
            'units' => 'required|numeric|between:1,1',
            'dateofbirth' => ['required', new AgeRestriction1],
            'reason' => 'required',
        ]);
        
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            // $transaction->price = Insuran_price::find(3)->price;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->units = $request->units;
            $transaction->contact_number = $request->contact_number;
            $transaction->email = $request->email;
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->reason = strtoupper($request->reason);
            $transaction->uploaded = false;
            $transaction->status = 'edited';
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_m.show', Crypt::encrypt($transaction->id));
    }

    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);

        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $transaction->uploaded = false;
            $transaction->status = 'deleted';
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }
        
        session(['success' => 'Record deleted successfully']);
        return redirect()->route('coi_m.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transaction as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.insured_name', 't.posted', 't.id', 't.beneficiary', 't.relationship'])
            ->where('t.type', 'M')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.terminal_coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.beneficiary', 'like', '%'.$request->search.'%')
                    ->orWhere('t.relationship', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);

        return view('transactions.coi_m.index', compact('search', 'transactions'));
    }

    public function post($id)
    {
        try {
            
            $transaction = Transaction::find(Crypt::decrypt($id));
            $transaction->uploaded = false;
            $transaction->posted = 1;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }

        session(['success' => 'Record posted successfully']);
        return redirect()->route('coi_m.index');
    }

    public function print($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            if($transaction->type == 'M') {
                PDF::SetTitle('COI M');
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

                PDF::setHeaderCallback(function() {
                    PDF::Image(public_path('images/logo.png'), 85, 5, 30, '', 'PNG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);
                    $header_content = '<table><tr><td align="center"><font size="15"><b>MAA General Assurance Phils., Inc.</b></font></td></tr><tr><td align="center"><font size="8">9<sup>th</sup>, 10<sup>th</sup> & 12<sup>th</sup> Floors, Pearlbank Centre, 146 Valero Street, Salcedo Village, Makati City 1227<br />TEL: (+632) 8867-2452 to 55; (+632) 7751-3759 FAX: (+632) 8893-2230</font></td></tr></table>';
                    PDF::Ln(14);
                    PDF::writeHTML($header_content, true, false, true, false, '');
                });

                PDF::setFooterCallback(function() {
                    PDF::Image(public_path('images/iso.jpg'), 1, 275, 17, '', 'JPG', '', 'T', false, 300, 'L', false, false, 0, false, false, false);
                    // PDF::Ln(2);
                    $footer_content = '<table><tr><td align="center"><font size="8"><b>BRANCHES:</b></font></td><td><font size="8"><b>Manila<br />Bulacan</b></font></td><td><font size="8"><b>Cebu<br />Batangas</b></font></td><td><font size="8"><b>Dagupan<br />Pampanga</b></font></td><td><font size="8"><b>Davao<br />General Santos</b></font></td><td><font size="8"><b>Bacolod<br />Cavite</b></font></td><td><font size="8"><b>Cagayan de Oro<br />Palawan</b></font></td></tr><tr><td colspan="7" align="center"><hr /><font size="8"><b>EMAIL: <a mailto:customerservice@maa.com.ph>customerservice@maa.com.ph</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WEBSITE: <a href="https://maa.com.ph" target="_blank">https://maa.com.ph</a></b></font></td></tr></table>';
                    PDF::writeHTML($footer_content, true, false, true, false, '');
                });

                PDF::SetPrintHeader(false);
                PDF::AddPage('P', 'A4');
                PDF::SetAutoPageBreak(false);
                PDF::Image(public_path('images/mdr.png'), 115, 114, 25);
                // PDF::Image(public_path('images/logo.png'), 107, 12, 20);
                // PDF::Image(public_path('images/logo.png'), 141, 272, 12);
                PDF::Image(public_path('images/maagap-logo.png'), 160, 267, 6);
                PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
                $view = \View::make('transactions.coi_m.coi_m-pdf', compact('transaction'));
                $html_content = $view->render();
                PDF::writeHTML($html_content, true, false, true, false, '');
                PDF::SetPrintFooter(false);

                PDF::SetMargins(10, 40, 10);

                PDF::SetPrintHeader(true);
                PDF::SetAutoPageBreak(true, 48);
                PDF::AddPage('P', 'A4');
                PDF::SetPrintFooter(true);
                PDF::SetHeaderMargin(0);
                // PDF::Ln(29);
                PDF::SetFont('Helvetica', '', 8);
                $view = \View::make('transactions.coi_m.coi_m-wordings', compact('transaction'));
                $html_content = $view->render();
                PDF::writeHTML($html_content, true, false, true, false, '');

            } else {
                PDF::AddPage('P', 'A4');
                PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');
            }
            PDF::SetFont('Helvetica', '', 10);
            PDF::Output('COI M.pdf');
            exit();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back();

        }
    }
}
