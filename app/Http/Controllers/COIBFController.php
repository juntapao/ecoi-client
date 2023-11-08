<?php

namespace App\Http\Controllers;

use View;
use PDF;
use App\Branch;
use Carbon\Carbon;
use App\Transaction;
use App\Relationship;
use Illuminate\Http\Request;
use App\Rules\AgeRestriction6;
use App\Rules\AlphabetStringOnly;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\CommonController;

class COIBFController extends Controller
{
    public function index()
    {
        try {
            //code...
            $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
            
            $transactions = DB::table('transactions as t')
                ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
                ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
                ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
                ->where('t.type', 'BF')
                ->where('t.status', '!=', 'deleted')
                ->where('b.branch_name', $branch_name)
                ->orderBy('t.id', 'desc')
                ->paginate(15);

            return view('transactions.coi_bf.index', compact('transactions'));
            
        } catch (\Throwable $th) {
            session(['error' => $exception->getMessage()]);
            return redirect()->back();
        }
    }

    public function create()
    {
        $branch = Branch::find(auth()->user()->branch_id);
        $relationships = Relationship::where('status', true)->get();
        $datenow = date('Y-m-d');
        return view('transactions.coi_bf.create', compact('branch', 'datenow', 'relationships'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'address' => 'required',
            'dateofbirth' => ['required', new AgeRestriction6],
            'relationship' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
        ]);

        $price_id = 8;
        $type_string = 'pinoy_protect_five';

        try {
            $transaction_policy_number = collect(session('systemSettings'))->where('name', $type_string)->pluck('value')->first();
            $transaction_price = collect(session('insurancePrices'))->where('id', $price_id)->pluck('price')->first();

            $transaction = new Transaction;
            $transaction->date_issued = Carbon::now()->format('Y-m-d');
            $transaction->terminal_coi_number = CommonController::getCoiNumber();
            $transaction->policy_number = $transaction_policy_number;
            $transaction->price = $transaction_price;
            $transaction->units = $request->units;
            $transaction->insured_name = strtoupper($request->insured_name);
            $transaction->address = strtoupper($request->address);
            $transaction->beneficiary = strtoupper($request->beneficiary);
            $transaction->relationship = strtoupper($request->relationship);
            $transaction->dateofbirth = $request->dateofbirth;
            $transaction->type = 'BF';
            $transaction->status = 'active';
            $transaction->posted = 0;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_bf.create')->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_bf.show', Crypt::encrypt($transaction->id));
    }

    public function show($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_bf.index');

        }
            
        return view('transactions.coi_bf.show', compact('id', 'transaction', 'relationships'));
    }

    public function edit($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            $relationships = Relationship::where('status', true)->get();
        
        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_bf.index');

        }
        
        return view('transactions.coi_bf.edit', compact('transaction', 'relationships'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'insured_name' => ['required', new AlphabetStringOnly],
            'address' => 'required',
            'dateofbirth' => ['required', new AgeRestriction6],
            'relationship' => 'required',
            'beneficiary' => ['required', new AlphabetStringOnly],
            'units' => 'required|numeric|between:1,5',
            'reason' => 'required',
        ]);
        
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
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
        return redirect()->route('coi_bf.show', Crypt::encrypt($transaction->id));
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
        return redirect()->route('coi_ao.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;
        
        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id', 't.bos_entry_number'])
            ->where('t.type', 'BF')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.terminal_coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.bos_entry_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.policy_number', 'like', '%'.$request->search.'%')
                    ->orWhere('t.insured_name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('t.id', 'desc')
            ->paginate(15);

        $search = $request->search;
        $transactions->appends(['search' => $search]);

        return view('transactions.coi_bf.index', compact('search', 'transactions'));
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
        return redirect()->route('coi_bf.index');
    }

    public function print($id)
    {
        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            if($transaction->type == 'BF') {

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
                
                $sum_insured = 20000 * $transaction->units;
                $holder['accident_principal'] = number_format($sum_insured, 2);
                $holder['unprovoked_principal'] = number_format(($sum_insured > 20000 ? 20000 : 10000), 2);
                $holder['motor_principal'] = number_format(($sum_insured > 20000 ? 20000 : 10000), 2);
                $holder['burial_principal'] = number_format(5000, 2);
            
                $holder['insured_age'] = Carbon::parse($transaction->dateofbirth)->age;

                if($holder['insured_age'] >= 65 && $holder['insured_age'] <= 75) {
                    $holder['accident_principal'] = number_format(str_replace(',','',$holder['accident_principal']) / 2, 2);
                    $holder['unprovoked_principal'] = number_format(str_replace(',','',$holder['unprovoked_principal']) / 2, 2);
                    $holder['motor_principal'] = number_format(str_replace(',','',$holder['motor_principal']) / 2, 2);
                    $holder['burial_principal'] = number_format(str_replace(',','',$holder['burial_principal']) / 2, 2);
                }

                $view = \View::make('transactions.coi_bf.coi_bf-pdf', compact('transaction', 'holder'));
                $html_content = $view->render();
                PDF::SetTitle('COI BF');
                PDF::AddPage("P", "A4");
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
                PDF::SetAutoPageBreak(TRUE, 0);
                PDF::Image(public_path('images/mdr.png'), 130, 108, 25);
                PDF::Image(public_path('images/logo.png'), 107, 12, 20);
                PDF::Image(public_path('images/ml_logo.png'), 15, 12, 48);
                PDF::writeHTML($html_content, true, false, true, false, '');
                
            } else {

                PDF::AddPage("P", "A4");
                PDF::writeHTML('<h3>Invalid record</h3>', true, false, true, false, '');

            }
            
            PDF::SetFont('Helvetica', '', 10);
            PDF::Output('COI BF.pdf');
            exit();

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back();

        }
    }
}
