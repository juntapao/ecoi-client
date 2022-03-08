<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Transaction;
use App\CoiAO ;
use App\Branch;
use App\PolicySeries;
use App\Insuran_price;
use App\Setting;
use DB;
use PDF;

class CoiAOController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.kpt_number'])
            ->where('t.type', 'AO')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_ao.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $datenow = date('Y-m-d');
        return view('transactions.coi_ao.create', compact('branch', 'datenow'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'coi_number' => 'required|unique:transaction',
            // 'kpt_number' => 'required',
            'insured_name' => 'required',
            'beneficiary' => 'required',
            'units' => 'required|numeric|between:1,5',
        ]);
        try {
            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->price = Insuran_price::find(1)->price;
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = Setting::where('name', 'kp_protect')->first()->value;
            $transaction->units = $request->units;
            $transaction->kpt_number = strtoupper($request->kpt_number);
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->type = 'AO';
            $transaction->status = 'active';
            $transaction->posted = false;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            if($transaction->save()) session(['success' => 'Record saved successfully']);
            else session(['error', 'Error on saving the record']);
        } catch(QueryException $ex) {
            // session(['error', $ex->getMessage()]);
            return redirect()->route('coi_ao.create')->withInput();
        }
        // $seriess = PolicySeries::find('5');
        // $polseries = $seriess->series;
        // $polseries1 = $polseries + 1;
        // $coiseries = $seriess->coi_no;
        // $coiseries1 = $coiseries + 1;
        // $seriess->series = sprintf('%06d',$polseries1);
        // $seriess->coi_no = sprintf('%07d',$coiseries1);
        // $seriess->save();
        return redirect()->route('coi_ao.show', $transaction->id);
    }

    public function show($id)
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $transaction = Transaction::find($id);
        return view('transactions.coi_ao.show', compact('id', 'transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions.coi_ao.edit')
            ->with('transaction', $transaction);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'kpt_number' => 'required',
            'insured_name' => 'required',
            'beneficiary' => 'required',
            'units' => 'required|min:1|max:5',
            'reason' => 'required',
        ]);
        $transaction = Transaction::find($id);
        $transaction->price = Insuran_price::find(1)->price;
        $transaction->kpt_number = strtoupper($request->kpt_number);
        $transaction->units = $request->units;
        $transaction->insured_name = strtoupper($request->insured_name);
        $transaction->beneficiary = strtoupper($request->beneficiary);
        $transaction->reason = strtoupper($request->reason);
        $transaction->status = 'edited';
        $transaction->uploaded = false;
        $transaction->userid_modified = auth()->user()->id;
        if($transaction->save()) session(['success' => 'Record saved successfully']);
        else session(['error', 'Error on saving the record']);
        return redirect()->route('coi_ao.show', $transaction->id);
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
            ->select(['t.status', 't.coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.kpt_number'])
            ->where('t.type', 'AO')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.kpt_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.policy_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);

        return view('transactions.coi_ao.index', compact('search', 'transactions'));
    }

    public function post($id)
    {
        $transaction = Transaction::find($id);
        $transaction->posted = true;
        $transaction->uploaded = false;
        if($transaction->save()) session(['success' => 'Record posted successfully']);
        else session(['error', 'Error on posting the record']);
        return redirect()->route('coi_ao.index');
    }

    public function print($id)
    {
        $transaction = Transaction::find($id);
        if($transaction->type == 'AO') {
            // $price = Insuran_price::find(1);
            $holder = array();
            // $holder1 = 0;
            // $holder2 = 0;
            // $holder3 = 0;
            // ==============================
            //  Principal Sum & Unprovoked Murder
            // ==============================
                ### Principal sum###
            // for($i = 0; $i < $transaction->units; $i++) {
            //     $holder1 = $holder1 + 20000;
            //     $holder['principal_sum'] = number_format($holder1, 2);
            // }
            // $holder1 = 0;
            
            // for($i = 0; $i < $transaction->units; $i++) {
            //     $holder1 = $holder1 + 30000;
            //     $holder['accident_principal'] = number_format($holder1, 2);
            // }
            // $holder1 = 0;
            //     ### Unprovoked Murder ###
            // for($i = 0; $i < $transaction->units; $i++) { 
            //     if($i < 2) {
            //         $holder2 = $holder2 + 20000;
            //         $holder['unprovoked_murder'] =  number_format($holder2, 2);
            //     }
            // }
            // $holder2 = 0;
            
            // for($i = 0; $i < $transaction->units; $i++) { 
            //     if($holder1 < 60000) {
            //         $holder1 = $holder1 + 30000;
            //         $holder['unprovoke_principal'] =  number_format($holder1, 2);
            //         $holder['motor_principal'] =  number_format($holder1, 2);
            //     }
            // }
            // $holder1 = 0;

            $sum_insured = 20000 * $transaction->units;
            $holder['accident_principal'] = number_format(($sum_insured > 100000 ? 100000 : $sum_insured), 2);
            $holder['unprovoked_murder'] = number_format(($sum_insured > 40000 ? 40000 : $sum_insured), 2);
            $holder['motor_principal'] = number_format(20000, 2);

            $view = \View::make('transactions/coi_ao.coi_ao-pdf', compact('transaction', 'holder'));
            $html_content = $view->render();
            PDF::SetTitle('COI AO');
            PDF::AddPage();
            PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            PDF::SetAutoPageBreak(TRUE, 0);
            PDF::Image(public_path('images/a.png'), 135, 100, 20);
            PDF::Image(public_path('images/logo.png'), 107, 12, 20);
            PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
            PDF::writeHTML($html_content, true, false, true, false, '');
        } else {
            PDF::AddPage("P", "A4");
            PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');
        }
        PDF::SetFont('Helvetica', '', 10);
        PDF::Output('COI AO.pdf');
        exit();
    }
    // public function getCoiNumber() {
    //     $coi_number = DB::table('transaction')->where('status', '!=', 'deleted')->max('coi_number');
    //     return substr('0000000'.(intval($coi_number) + 1), -7);
    // }
}
