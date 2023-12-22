<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Transaction;
use App\Dependent;
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
use App\Rules\AlphabetStringOnly;

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
            'insured_name' => ['required', new AlphabetStringOnly],
            'dateofbirth' => ['required', new AgeRestriction1],
            'guardian' => ['required_with:guardian_dateofbirth|required_with:relationship_1_1', new AlphabetStringOnly],
            'guardian2' => ['required_with:guardian_dateofbirth2|required_with:relationship_1_2', new AlphabetStringOnly],
            'child_siblings' => ['required_with:child_siblings_dateofbirth|required_with:relationship_2_1', new AlphabetStringOnly],
            'child_siblings2' => ['required_with:child_siblings_dateofbirth2|required_with:relationship_2_2', new AlphabetStringOnly],
            'child_siblings3' => ['required_with:child_siblings_dateofbirth3|required_with:relationship_2_3', new AlphabetStringOnly],
            'child_siblings4' => ['required_with:child_siblings_dateofbirth4|required_with:relationship_2_4', new AlphabetStringOnly],
            'guardian_dateofbirth' => ['required_with:guardian', new AgeRestriction1],
            'guardian_dateofbirth2' => ['required_with:guardian2', new AgeRestriction1],
            'child_siblings_dateofbirth' =>  ['required_with:child_siblings', new AgeRestriction2],
            'child_siblings_dateofbirth2' => ['required_with:child_siblings2', new AgeRestriction2],
            'child_siblings_dateofbirth3' => ['required_with:child_siblings3', new AgeRestriction2],
            'child_siblings_dateofbirth4' => ['required_with:child_siblings4', new AgeRestriction2],
            'relationship_1_1' => 'required_with:guardian',
            'relationship_1_2' => 'required_with:guardian2',
            'relationship_2_1' => 'required_with:child_siblings',
            'relationship_2_2' => 'required_with:child_siblings2',
            'relationship_2_3' => 'required_with:child_siblings3',
            'relationship_2_4' => 'required_with:child_siblings4',
        ]);

        $price_id = 4;
        $type_string = 'family_protect_plus';

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
            $transaction->posted = 0;
            $transaction->userid_created = auth()->user()->id;
            $transaction->userbranch = $request->userbranch;
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

            $dependents_array = ['relationship_1_1', 'relationship_1_2', 'relationship_2_1', 'relationship_2_2', 'relationship_2_3', 'relationship_2_4'];
            foreach($dependents_array as $d) {
                if($request->input($d)) {
                    $dependent = new Dependent;
                    $dependent->transaction_id = $transaction->id;
                    $dependent->field = Str::substr($d, -3);
                    $dependent->relationship = $request->input($d);
                    $dependent ->save();
                }
            }

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_a.create')->withInput();

        }

        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_a.show', Crypt::encrypt($transaction->id));
    }

    public function show($id)
    {
        try {

            $transaction = Transaction::with(['dependents'])->find(Crypt::decrypt($id));

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_a.index');

        }

        return view('transactions.coi_a.show', compact('id', 'transaction'));
    }

    public function edit($id)
    {
        try {

            $transaction = Transaction::with(['dependents'])->find(Crypt::decrypt($id));
        
        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->route('coi_a.index');

        }
        
        return view('transactions.coi_a.edit')->with('transaction', $transaction);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'bos_number' => 'required',
            'units' => 'required|numeric|between:1,5',
            'insured_name' => ['required', new AlphabetStringOnly],
            'dateofbirth' => ['required', new AgeRestriction1],
            'guardian' => ['required_with:guardian_dateofbirth', new AlphabetStringOnly],
            'guardian_dateofbirth' => ['required_with:guardian', new AgeRestriction1],
            'guardian2' => ['required_with:guardian_dateofbirth2', new AlphabetStringOnly],
            'guardian_dateofbirth2' => ['required_with:guardian2', new AgeRestriction1],
            'child_siblings' => ['required_with:child_siblings_dateofbirth', new AlphabetStringOnly],
            'child_siblings_dateofbirth' =>  ['required_with:child_siblings', new AgeRestriction2],
            'child_siblings2' => ['required_with:child_siblings_dateofbirth2', new AlphabetStringOnly],
            'child_siblings_dateofbirth2' => ['required_with:child_siblings2', new AgeRestriction2],
            'child_siblings3' => ['required_with:child_siblings_dateofbirth3', new AlphabetStringOnly],
            'child_siblings_dateofbirth3' => ['required_with:child_siblings3', new AgeRestriction2],
            'child_siblings4' => ['required_with:child_siblings_dateofbirth4', new AlphabetStringOnly],
            'child_siblings_dateofbirth4' => ['required_with:child_siblings4', new AgeRestriction2],
            'reason' => 'required',
            'relationship_1_1' => 'required_with:guardian',
            'relationship_1_2' => 'required_with:guardian2',
            'relationship_2_1' => 'required_with:child_siblings',
            'relationship_2_2' => 'required_with:child_siblings2',
            'relationship_2_3' => 'required_with:child_siblings3',
            'relationship_2_4' => 'required_with:child_siblings4',
        ]);

        try {

            $transaction = Transaction::find(Crypt::decrypt($id));
            // $transaction->price = Insuran_price::find(4)->price;
            // $transaction->bos_entry_number = $request->bos_entry_number;
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
            $transaction->uploaded = false;
            $transaction->status = 'edited';
            $transaction->userid_modified = auth()->user()->id;
            $transaction->save();

            // DELETE ALL DEPENDENTS FIRST
            foreach($transaction->dependents as $d) {
                $d->forceDelete();
            }

            $dependents_array = ['relationship_1_1', 'relationship_1_2', 'relationship_2_1', 'relationship_2_2', 'relationship_2_3', 'relationship_2_4'];
            foreach($dependents_array as $d) {
                if($request->input($d)) {
                    $dependent = new Dependent;
                    $dependent->transaction_id = $transaction->id;
                    $dependent->field = Str::substr($d, -3);
                    $dependent->relationship = $request->input($d);
                    $dependent ->save();
                }
            }


        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }
        session(['success' => 'Record saved successfully']);
        return redirect()->route('coi_a.show', Crypt::encrypt($transaction->id));
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

            // DELETE ALL DEPENDENTS
            foreach($transaction->dependents as $d) {
                $d->delete();
            }

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back()->withInput();

        }
        
        session(['success' => 'Record deleted successfully']);
        return redirect()->route('coi_a.index');
    }

    public function search(Request $request)
    {
        $branch_name = session('branchName') ?? auth()->user()->branch->branch_name;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.status', 't.terminal_coi_number', 't.policy_number', 't.insured_name', 't.posted', 't.id'])
            ->where('t.type', 'A')
            ->where('t.status', '!=', 'deleted')
            ->where('b.branch_name', $branch_name)
            ->where(function($query) use ($request) {
                $query->where('t.terminal_coi_number', 'like', '%'.$request->search.'%')
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
        return redirect()->route('coi_a.index');
    }
    
    public function print($id)
    {
        try {

            $transaction = Transaction::with(['dependents'])->find(Crypt::decrypt($id));

            if($transaction->type == 'A') {
                $holder = array();

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
    
                $holder['accident_child_siblings'] = $holder['accident_principal'] / 4;
                $holder['unprovoked_child_siblings'] = $holder['unprovoked_principal'] / 4;
                $holder['motor_child_siblings'] = $holder['motor_principal'] / 4;
                $holder['burial_child_siblings'] = $holder['burial_principal'] / 4;
                $holder['cash_child_siblings'] = $holder['cash_principal'] / 4;

                $view = \View::make('transactions.coi_a.coi_a-pdf', compact('transaction', 'holder'));
                $html_content = $view->render();
                PDF::SetTitle('COI A');
                PDF::AddPage("P", "A4");
                PDF::SetFooterMargin(PDF_MARGIN_FOOTER);
                PDF::SetAutoPageBreak(FALSE, 0);
                PDF::Image(public_path('images/mdr.png'), 130, 128, 25);
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

        } catch(\Exception $exception) {

            session(['error' => $exception->getMessage()]);
            return redirect()->back();

        }
    }
}
