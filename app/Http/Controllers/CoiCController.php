<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use View;
use App\Branch;
use Carbon\Carbon;
use App\Transaction;
use App\Relationship;
use Illuminate\Http\Request;
use App\Rules\AgeRestriction1;
use App\Rules\AgeRestriction5;
use App\Rules\AlphabetStringOnly;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\CommonController;

class CoiCController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
            ->where('t.type', 'C')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_c.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $relationships = Relationship::where('status', true)->get();
        $datenow = date('Y-m-d');
        return view('transactions.coi_c.create', compact('branch', 'datenow', 'relationships'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'address' => 'required',
            'dateofbirth' => ['required', new AgeRestriction5],
            'relationship' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
        ]);

        $price_id = 9;
        $type_string = 'customer_protect';

        try {
            $transaction_policy_number = collect(session('systemSettings'))->where('name', $type_string)->pluck('value')->first();
            $transaction_price = collect(session('insurancePrices'))->where('id', $price_id)->pluck('price')->first();
            
            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            // $transaction->price = Insuran_price::find(5)->price;
            // $transaction->coi_number = CommonController::getCoiNumber();
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = $transaction_policy_number;
            $transaction->price = $transaction_price;
            // $transaction->policy_number = Setting::find(3)->value;
            // $transaction->bos_entry_number = $request->input('bos_entry_number');
            $transaction->units = $request->units;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->address = strtoupper($request->address);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->type = 'C';
            $transaction->status = 'active';
            $transaction->posted = 0;
            // $transaction->reprint = 0;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

            Transaction::where('id', $transaction->id)->update([
                'coi_number' => str_pad($transaction->id, 8, '0', STR_PAD_LEFT),
            ]);

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_c.create')->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_c.show', Crypt::encrypt($transaction->id));
    }

    public function show($id)
    {
        try {

            // $branch = Branch::find(auth()->user()->branch_id);
            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_c.index');

        }
            
        return view('transactions.coi_c.show', compact('id', 'transaction', 'relationships'));
    }

    public function edit($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();
        
        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_c.index');

        }
        
        return view('transactions.coi_c.edit', compact('transaction', 'relationships'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'address' => 'required',
            'dateofbirth' => ['required', new AgeRestriction5],
            'relationship' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
            'reason' => 'required',
        ]);
        
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            // $transaction->price = Insuran_price::find(5)->price;
            $transaction->units = $request->units;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->address = strtoupper($request->address);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->status = 'edited';
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_c.show', Crypt::encrypt($transaction->id));
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
        return redirect()->route('coi_c.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
            ->where('t.type', 'C')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.bos_entry_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.policy_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);

        return view('transactions.coi_c.index', compact('search', 'transactions'));
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
        return redirect()->route('coi_c.index');
    }

    public function print($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
                $holder = array();
                
                $sum_insured = 10000 * $transaction->units;
                $holder['accident_principal'] = $sum_insured;
                $holder['dismemberment'] = $sum_insured/2;
                $holder['unprovoked_principal'] = (( 5000 * $transaction->units ) > 15000 ? 15000 : ( 5000 * $transaction->units ));
                $holder['motor_principal'] = (( 5000 * $transaction->units ) > 15000 ? 15000 : ( 5000 * $transaction->units ));
                $holder['burial_principal'] = (( 3000 * $transaction->units ) > 10000 ? 10000 : ( 3000 * $transaction->units ));
                $holder['medical_reimbursement'] = (( 2000 * $transaction->units ) > 5000 ? 5000 : ( 2000 * $transaction->units ));
            
                if(Carbon::parse($transaction->dateofbirth)->age > 65){
                    $holder['accident_principal'] = number_format($holder['accident_principal'] / 2, 2);
                    $holder['dismemberment'] = number_format($holder['dismemberment'] / 2, 2);
                    $holder['unprovoked_principal'] = number_format($holder['unprovoked_principal'] / 2, 2);
                    $holder['motor_principal'] = number_format($holder['motor_principal'] / 2, 2);
                    $holder['burial_principal'] = number_format($holder['burial_principal'] / 2, 2);
                    $holder['medical_reimbursement'] = number_format($holder['medical_reimbursement'] / 2, 2);
                } else {
                    $holder['accident_principal'] = number_format($holder['accident_principal'], 2);
                    $holder['dismemberment'] = number_format($holder['dismemberment'], 2);
                    $holder['unprovoked_principal'] = number_format($holder['unprovoked_principal'], 2);
                    $holder['motor_principal'] = number_format($holder['motor_principal'], 2);
                    $holder['burial_principal'] = number_format($holder['burial_principal'], 2);
                    $holder['medical_reimbursement'] = number_format($holder['medical_reimbursement'], 2);
                }
                
                $view = View::make('transactions.coi_c.coi_c-pdf', compact('transaction', 'holder'));
                $html_content = $view->render();
                PDF::SetTitle('COI C');
                PDF::AddPage("P", "A4");
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
                PDF::SetAutoPageBreak(TRUE, 0);
                PDF::Image(public_path('images/mdr.png'), 130, 110, 25);
                PDF::Image(public_path('images/FINAL MAAGAP HEADER 2.png'), 147, 12, 50);
                PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
                PDF::writeHTML($html_content, true, false, true, false, '');

                PDF::SetFont('Helvetica', '', 10);
                PDF::Output('COI C.pdf');

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back();

        }
    }
}
