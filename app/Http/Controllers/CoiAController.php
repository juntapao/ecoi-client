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
use App\Rules\AgeRestriction;
use App\Rules\AgeRestriction1;
use App\Rules\AgeRestriction2;
use DB;
use PDF;

class CoiAController extends Controller
{
    public function index()
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id'])
            ->where('t.type', 'A')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        return view('transactions.coi_a.index', compact('transactions'));
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $datenow = date('Y-m-d');
        return view('transactions.coi_a.create', compact('branch', 'datenow'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'units' => 'required|numeric|between:1,5',
            'insured_name' => 'required',
            'dateofbirth' => ['required', new AgeRestriction1],
            'guardian' => 'required_with:guardian_dateofbirth',
            'guardian_dateofbirth' => ['required_with:guardian', new AgeRestriction1],
            'guardian2' => 'required_with:guardian_dateofbirth2',
            'guardian_dateofbirth2' => ['required_with:guardian2', new AgeRestriction1],
            'child_siblings' => 'required_with:child_siblings_dateofbirth',
            'child_siblings_dateofbirth' =>  ['required_with:child_siblings', new AgeRestriction2],
            'child_siblings2' => 'required_with:child_siblings_dateofbirth2',
            'child_siblings_dateofbirth2' => ['required_with:child_siblings2', new AgeRestriction2],
            'child_siblings3' => 'required_with:child_siblings_dateofbirth3',
            'child_siblings_dateofbirth3' => ['required_with:child_siblings3', new AgeRestriction2],
            'child_siblings4' => 'required_with:child_siblings_dateofbirth4',
            'child_siblings_dateofbirth4' => ['required_with:child_siblings4', new AgeRestriction2],
        ]);
        try {
            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = Setting::where('name', 'family_protect_plus')->first()->value;
            $transaction->price = Insuran_price::find(4)->price;
            $transaction->units = $request->units;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->civil_status = $request->civil_status;
            $transaction->guardian = strtoupper($request->guardian);
            $transaction->guardian_dateofbirth = $request->guardian_dateofbirth;
            $transaction->guardian2 = strtoupper($request->guardian2);
            $transaction->guardian_dateofbirth2 = $request->guardian_dateofbirth2;
            $transaction->child_siblings = strtoupper($request->child_siblings);
            $transaction->child_siblings_dateofbirth = $request->child_siblings_dateofbirth;
            $transaction->child_siblings2 = strtoupper($request->child_siblings2);
            $transaction->child_siblings_dateofbirth2 = $request->child_siblings_dateofbirth2;
            $transaction->child_siblings3 = strtoupper($request->child_siblings3);
            $transaction->child_siblings_dateofbirth3 = $request->child_siblings_dateofbirth3;
            $transaction->child_siblings4 = strtoupper($request->child_siblings4);
            $transaction->child_siblings_dateofbirth4 = $request->child_siblings_dateofbirth4;
            $transaction->type = 'A';
            $transaction->status = 'active';
            $transaction->posted = false;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            if($transaction->save()) {
                session(['success' => 'Record saved successfully']);
            } else {
                session(['error', 'Error on saving the record']);
            }
        } catch(QueryException $ex) {
            return redirect()->route('coi_a.create')->withInput();
        }
        return redirect()->route('coi_a.show', $transaction->id);
    }

    public function show($id)
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $transaction = Transaction::find($id);
        return view('transactions.coi_a.show', compact('id', 'transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions/coi_a.edit')->with('transaction', $transaction);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'bos_number' => 'required',
            'units' => 'required|numeric|between:1,5',
            'insured_name' => 'required',
            'dateofbirth' => ['required', new AgeRestriction1],
            'guardian' => 'required_with:guardian_dateofbirth',
            'guardian_dateofbirth' => ['required_with:guardian', new AgeRestriction1],
            'guardian2' => 'required_with:guardian_dateofbirth2',
            'guardian_dateofbirth2' => ['required_with:guardian2', new AgeRestriction1],
            'child_siblings' => 'required_with:child_siblings_dateofbirth',
            'child_siblings_dateofbirth' =>  ['required_with:child_siblings', new AgeRestriction2],
            'child_siblings2' => 'required_with:child_siblings_dateofbirth2',
            'child_siblings_dateofbirth2' => ['required_with:child_siblings2', new AgeRestriction2],
            'child_siblings3' => 'required_with:child_siblings_dateofbirth3',
            'child_siblings_dateofbirth3' => ['required_with:child_siblings3', new AgeRestriction2],
            'child_siblings4' => 'required_with:child_siblings_dateofbirth4',
            'child_siblings_dateofbirth4' => ['required_with:child_siblings4', new AgeRestriction2],
            'reason' => 'required',
        ]);
        $transaction = Transaction::find($id);
        $transaction->price = Insuran_price::find(4)->price;
        $transaction->units = $request->units;
        $transaction->insured_name = strtoupper($request->insured_name);
        $transaction->dateofbirth = $request->dateofbirth;
        $transaction->civil_status = $request->civil_status;
        $transaction->guardian = strtoupper($request->guardian);
        $transaction->guardian_dateofbirth = $request->guardian_dateofbirth;
        $transaction->guardian2 = strtoupper($request->guardian2);
        $transaction->guardian_dateofbirth2 = $request->guardian_dateofbirth2;
        $transaction->child_siblings = strtoupper($request->child_siblings);
        $transaction->child_siblings_dateofbirth = $request->child_siblings_dateofbirth;
        $transaction->child_siblings2 = strtoupper($request->child_siblings2);
        $transaction->child_siblings_dateofbirth2 = $request->child_siblings_dateofbirth2;
        $transaction->child_siblings3 = strtoupper($request->child_siblings3);
        $transaction->child_siblings_dateofbirth3 = $request->child_siblings_dateofbirth3;
        $transaction->child_siblings4 = strtoupper($request->child_siblings4);
        $transaction->child_siblings_dateofbirth4 = $request->child_siblings_dateofbirth4;
        $transaction->reason = strtoupper($request->reason);
        $transaction->status = 'edited';
        $transaction->uploaded = false;
        $transaction->userid_modified = auth()->user()->id;
        if($transaction->save()) session(['success' => 'Record saved successfully']);
        else session(['error', 'Error on saving the record']);
        return redirect()->route('coi_a.show', $transaction->id);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'deleted';
        $transaction->uploaded = false;
        if($transaction->save()) session(['success' => 'Record deleted successfully']);
        else session(['error', 'Error on deleting the record']);
        return redirect()->route('coi_a.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id'])
            ->where('t.type', 'A')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.policy_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);
        return view('transactions.coi_a.index', compact('search', 'transactions'));
    }

    public function post($id)
    {
        $transaction = Transaction::find($id);
        $transaction->posted = true;
        $transaction->uploaded = false;
        if($transaction->save()) session(['success' => 'Record posted successfully']);
        else session(['error', 'Error on posting the record']);
        return redirect()->route('coi_a.index');
    }
    
    public function print($id)
    {
        $transaction = Transaction::find($id);
        if($transaction->type == 'A') {
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
            //     ### Spouse / Parents ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     $holder2 = $holder2 + 15000;
            //     $holder['accident_spouse_parents'] =  number_format($holder2,2);
            // }$holder2 = 0;
            //     ### Children / Siblings ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     $holder3 = $holder3 + 10000;
            //     //echo $holder3.'<br>';
            //     $holder['accident_child_siblings'] =  number_format($holder3,2);
            // }$holder3 = 0;
    
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
            //     ### Spouse / Parents ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder2 <= 60000) {
            //         $holder2 = $holder2 + 15000;
            //         if($holder2 > 30000) $holder2 = 30000;
            //         $holder['unprovoke_spouse_parents'] =  number_format($holder2,2);
            //         $holder['motor_spouse_parents'] =  number_format($holder2,2);
            //     }
            // }$holder2 = 0;
            //     ### Children / Siblings ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder3 <= 60000) {
            //         $holder3 = $holder3 + 5000;
            //         if($holder3 > 10000) $holder3 = 10000;
            //         $holder['unprovoke_child_siblings'] =  number_format($holder3,2);
            //         $holder['motor_child_siblings'] =  number_format($holder3,2);
            //     }
            // }$holder3 = 0;
    
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
            //     ### Spouse / Parents ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder2 <= 10000) {
            //         $holder2 = $holder2 + 5000;
            //         if($holder2 > 5000) $holder2 = 5000;
            //         $holder['burial_spouse_parents'] =  number_format($holder2,2);
            //         $holder['cash_spouse_parents'] =  number_format($holder2,2);
            //     }
            // }$holder2 = 0;
            //     ### Children / Siblings ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder3 < 10000) {
            //         $holder3 = $holder3 + 2500;
            //         if($holder3 > 2500) $holder3 = 2500;
            //         $holder['burial_child_siblings'] =  number_format($holder3,2);
            //         $holder['cash_child_siblings'] =  number_format($holder3,2);
            //     }
                        
            // }$holder3 = 0;
    
            // // =============================   
            // //  Fire Assistance       
            // // =============================    
            //     ### Principal ###
            // for ($i=0; $i < $transaction->units; $i++) { 
            //     if ($holder1 < 5000) {
            //         $holder1 = $holder1 + 5000;
            //         $holder['fire_principal'] =  number_format($holder1,2);
            //     }
            // }
            // $holder1 = 0;


            $sum_insured = 30000 * $transaction->units;
            $holder['accident_principal'] = $sum_insured;
            $holder['unprovoked_principal'] = $sum_insured > 60000 ? 60000 : $sum_insured;
            $holder['motor_principal'] = ($sum_insured > 60000 ? 60000 : $sum_insured);
            $holder['burial_principal'] = 10000;
            $holder['cash_principal'] = 10000;
            $holder['fire_principal'] = 5000;

            $holder['accident_spouse_parents'] = $holder['accident_principal'] / 2;
            $holder['unprovoked_spouse_parents'] = $holder['unprovoked_principal'] / 2;
            $holder['motor_spouse_parents'] = $holder['motor_principal'] / 2;
            $holder['burial_spouse_parents'] = $holder['burial_principal'] / 2;
            $holder['cash_spouse_parents'] = $holder['cash_principal'] / 2;
            $holder['fire_spouse_parents'] = $holder['fire_principal'] / 2;

            $holder['accident_child_siblings'] = $holder['accident_principal'] / 4;
            $holder['unprovoked_child_siblings'] = $holder['unprovoked_principal'] / 4;
            $holder['motor_child_siblings'] = $holder['motor_principal'] / 4;
            $holder['burial_child_siblings'] = $holder['burial_principal'] / 4;
            $holder['cash_child_siblings'] = $holder['cash_principal'] / 4;
            $holder['fire_child_siblings'] = $holder['fire_principal'] / 4;

            $view = \View::make('transactions.coi_a.coi_a-pdf', compact('transaction', 'holder'));
            $html_content = $view->render();
            PDF::SetTitle('COI A');
            PDF::AddPage("P", "A4");
            PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            PDF::SetAutoPageBreak(TRUE, 0);
            PDF::Image(public_path('images/a.png'), 135, 130, 20);
            PDF::Image(public_path('images/logo.png'), 107, 12, 20);
            PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
            //PDF::Image("../public/images/logo.png", 10, 13, 30.5);
            PDF::writeHTML($html_content, true, false, true, false, '');
        } else {
            PDF::AddPage("P", "A4");
            PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');
        }
        PDF::SetFont('Helvetica', '', 10);
        PDF::Output('COI A.pdf');
        exit();
    }
}
