<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\AlphabetStringOnly;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Transaction;
use App\CoiAO ;
use App\Branch;
use App\PolicySeries;
use App\Insuran_price;
use App\Setting;
use DB;
use PDF;

class CoiRController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.kpt_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.ticket_number'])
            ->where('t.type', 'R')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_r.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $datenow = date('Y-m-d');
        return view('transactions.coi_r.create', compact('branch', 'datenow'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_number' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'insured_name' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
        ]);
        
        $price_id = 3;
        $type_string = 'pawners_protect';

        try {
            $transaction_policy_number = collect(session('systemSettings'))->where('name', $type_string)->pluck('value')->first();
            $transaction_price = collect(session('insurancePrices'))->where('id', $price_id)->pluck('price')->first();

            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = $transaction_policy_number;
            $transaction->price = $transaction_price;
            $transaction->units = $request->units;
            $transaction->ticket_number = strtoupper($request->ticket_number);
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->type = 'R';
            $transaction->status = 'active';
            $transaction->posted = 0;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_r.create')->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_r.show', Crypt::encrypt($transaction->id));
    }

    public function show($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_r.index');

        }

        return view('transactions.coi_r.show', compact('id', 'transaction'));
    }

    public function edit($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
        
        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_r.index');

        }

        return view('transactions.coi_r.edit')->with('transaction', $transaction);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ticket_number' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'insured_name' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
            'reason' => 'required',
        ]);
        
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $transaction->units = $request->units;
            $transaction->ticket_number = strtoupper($request->ticket_number);
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->reason = strtoupper($request->reason);
            $transaction->status = 'edited';
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_r.show', Crypt::encrypt($transaction->id));
    }

    public function destroy(Request $request, $id)
    {
        $this->validate($request, [
            'reason' => 'required',
        ]);
        
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $transaction->status = 'deleted';
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }
        
        session(['success' => 'Record deleted successfully']);
        return redirect()->route('coi_r.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.kpt_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.ticket_number'])
            ->where('t.type', 'R')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.terminal_coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.ticket_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.policy_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);

        return view('transactions.coi_r.index', compact('search', 'transactions'));
    }

    public function post($id)
    {
        try {
            
            $transaction = Transaction::find(Crypt::decrypt($id));
            $transaction->posted = 1;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }

        session(['success' => 'Record posted successfully']);
        return redirect()->route('coi_r.index');
    }

    public function print($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            if($transaction->type == 'R') {

                $holder = array();

                $sum_insured = 30000 * $transaction->units;
                $holder['accident_principal'] = number_format(($sum_insured > 150000 ? 150000 : $sum_insured), 2);
                $holder['unprovoked_murder'] = number_format(($sum_insured > 60000 ? 60000 : $sum_insured), 2);
                $holder['motor_principal'] = number_format(30000, 2);

                $view = \View::make('transactions.coi_r.coi_r-pdf', compact('transaction', 'holder'));
                $html_content = $view->render();
                PDF::SetTitle('COI R');
                PDF::AddPage("P", "A4");
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
                PDF::SetAutoPageBreak(TRUE, 0);
                PDF::Image(public_path('images/mdr.png'), 130, 96, 25);
                PDF::Image(public_path('images/logo.png'), 107, 12, 20);
                PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
                PDF::writeHTML($html_content, true, false, true, false, '');

            } else {

                PDF::AddPage("P", "A4");
                PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');

            }
            PDF::SetFont('Helvetica', '', 10);
            PDF::Output('COI R.pdf');
            exit();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back();

        }
    }
}
