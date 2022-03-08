<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Transaction;
use App\CoiAO ;
use App\Branch;
use App\PolicySeries;
use App\Insuran_price;
use App\Setting;
use DB;
use PDF;

class CoiBController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
            ->where('t.type', 'B')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_b.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $datenow = date('Y-m-d');
        return view('transactions.coi_b.create', compact('branch', 'datenow'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'insured_name' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'relationship' => 'required',
            'beneficiary' => 'required',
            'units' => 'required|numeric|between:1,5',
        ]);
        try {
            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->price = Insuran_price::find(5)->price;
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = Setting::where('name', 'pinoy_protect_plus')->first()->value;
            // $transaction->bos_entry_number = $request->input('bos_entry_number');
            $transaction->units = $request->units;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->address = strtoupper($request->address);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->type = 'B';
            $transaction->status = 'active';
            $transaction->posted = false;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            if($transaction->save()) session(['success' => 'Record saved successfully']);
            else session(['error', 'Error on saving the record']);
        } catch(QueryException $ex) {
            return redirect()->route('coi_b.create')->withInput();
        }
        return redirect()->route('coi_b.show', $transaction->id);
    }

    public function show($id)
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $transaction = Transaction::find($id);
        return view('transactions.coi_b.show', compact('id', 'transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions.coi_b.edit')
            ->with('transaction', $transaction);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'insured_name' => 'required',
            'address' => 'required',
            'dateofbirth' => 'required',
            'relationship' => 'required',
            'beneficiary' => 'required',
            'units' => 'required|numeric|between:1,5',
            'reason' => 'required',
        ]);
        $transaction = Transaction::find($id);
        $transaction->price = Insuran_price::find(5)->price;
        $transaction->units = $request->units;
        $transaction->insured_name = strtoupper($request->insured_name);
        $transaction->address = strtoupper($request->address);
        $transaction->beneficiary = strtoupper($request->beneficiary);
        $transaction->relationship = strtoupper($request->relationship);
        $transaction->dateofbirth = $request->dateofbirth;
        $transaction->status = 'edited';
        $transaction->uploaded = false;
        $transaction->userid_modified = auth()->user()->id;
        if($transaction->save()) session(['success' => 'Record saved successfully']);
        else session(['error', 'Error on saving the record']);
        return redirect()->route('coi_b.show', $transaction->id);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'deleted';
        $transaction->uploaded = false;
        if($transaction->save()) session(['success' => 'Record deleted successfully']);
        else session(['error', 'Error on deleting the record']);
        return redirect()->route('coi_ao.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
            ->where('t.type', 'B')
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

        return view('transactions.coi_b.index', compact('search', 'transactions'));
    }

    public function post($id)
    {
        $transaction = Transaction::find($id);
        $transaction->posted = true;
        $transaction->uploaded = false;
        if($transaction->save()) session(['success' => 'Record posted successfully']);
        else session(['error', 'Error on posting the record']);
        return redirect()->route('coi_b.index');
    }

    public function print($id)
    {
        $transaction = Transaction::find($id);
        if($transaction->type == 'B') {
            $holder = array();
            // $holder1 = 0;
            // $holder2 = 0;
            // $holder3 = 0;
            // // ==============================
            // //  Accidental Death/ Disablement
            // // ==============================
            //     ### Principal ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     $holder1 = $holder1 + 30000;
            //     $holder['accident_principal'] =  number_format($holder1,2);
            // }$holder1 = 0;

            // // =============================    ============================= 
            // //  Unprovoke Murder or Assault  ||  Motorcycling
            // // =============================    =============================
            //     ### Principal ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder1 < 60000) {
            //         $holder1 = $holder1 + 30000;
            //         $holder['unprovoke_principal'] =  number_format($holder1,2);
            //         $holder['motor_principal'] =  number_format($holder1,2);
            //     }
                    
            // }$holder1 = 0;

            // // =============================    ============================= 
            // //  Accidental Burial            ||  Cash Assistance Benefit
            // // =============================    =============================
            //     ### Principal ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder1 < 10000) {
            //         $holder1 = $holder1 + 10000;
            //         $holder['burial_principal'] =  number_format($holder1,2);
            //         $holder['cash_principal'] =  number_format($holder1,2);
            //     }
            // }$holder1 = 0;

            // // =============================   
            // //  Educational Assistance
            // // =============================    
            //     ### Accidental ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder1 < 25000) {
            //         $holder1 = $holder1 + 5000;
            //         $holder['accidental'] =  number_format($holder1,2);
            //     }
            // }$holder1 = 0;
            //     ### Sickness ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder1 < 12500) {
            //         $holder1 = $holder1 + 2500;
            //         $holder['sickness'] =  number_format($holder1,2);
            //     }
            // }$holder1 = 0;

            $sum_insured = 30000 * $transaction->units;
            $holder['accident_principal'] = number_format($sum_insured, 2);
            $holder['unprovoked_principal'] = number_format(($sum_insured > 60000 ? 60000 : $sum_insured), 2);
            $holder['motor_principal'] = number_format(($sum_insured > 60000 ? 60000 : $sum_insured), 2);
            $holder['burial_principal'] = number_format(10000, 2);
            $holder['cash_principal'] = number_format(10000, 2);
            $holder['accidental'] = number_format(25000, 2);
            $holder['sickness'] = number_format(12500, 2);
        
            $view = \View::make('transactions.coi_b.coi_b-pdf', compact('transaction', 'holder'));
            $html_content = $view->render();
            PDF::SetTitle('COI B');
            PDF::AddPage("P", "A4");
            PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            PDF::SetAutoPageBreak(TRUE, 0);
            PDF::Image(public_path('images/a.png'), 135, 125, 20);
            PDF::Image(public_path('images/logo.png'), 107, 12, 20);
            PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
            PDF::writeHTML($html_content, true, false, true, false, '');
        } else {
            PDF::AddPage("P", "A4");
            PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');
        }
        PDF::SetFont('Helvetica', '', 10);
        PDF::Output('COI B.pdf');
        exit();
    }
}
