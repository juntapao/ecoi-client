<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use App\Transaction;
use App\Area;
use App\Region;
use App\Branch;
use App\Exports\Detailed;
use DB;

class DetailedController extends Controller
{
    public function index()
    {
        $regions = Region::where('status', 1)
            ->orderBy('region_name')
            ->get();
        $areas = Area::where('status', 1)
            ->orderBy('area_name')
            ->get();
        $branches = Branch::where('status', 1)
            ->orderBy('branch_name')
            ->get();
        return view('reports.detailed.index', compact('regions', 'areas', 'branches'));
    }

    public function create() { }

    public function store(Request $request)
    {
        $request->validate([
            'date_from' => 'required|before_or_equal:date_to',
            'date_to' => 'required|after_or_equal:date_from',
        ]);

        CommonController::fixUnpostedTransactions($request->date_from, $request->date_to);

        $row = 5;
        $file_name = 'Detailed_Report_'.auth()->user()->id.'_'.Carbon::now()->format('ymdHis').'.xlsx';
        $spreadsheet = new Spreadsheet();
        $with_transaction = false;
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $transactions = DB::table('transaction as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.coi_number', 't.policy_number', 't.insured_name', 't.type', 't.units', 't.price', 
                't.date_issued', 't.status', 't.posted', 't.created_at', 'b.branch_name', 'u.username'])
            ->where('t.status', '!=', 'deleted')
            ->whereBetween('date_issued', [$request->date_from, $request->date_to])
            ->when($request->input('product'), function($query, $products) {
                    return $query->whereIn('type', $products);
                })
            ->when($request->input('branch'), function($query, $branches) {
                    return $query->whereIn('b.branch_name', $branches);
                })
            ->when($request->input('area'), function($query, $areas) {
                    $branches = Branch::whereIn('area_id', $areas)->pluck('branch_name');
                    return $query->whereIn('b.branch_name', $branches);
                })
            ->when($request->input('region'), function($query, $regions) {
                    $areas = Area::whereIn('region_id', $regions)->pluck('id');
                    $branches = Branch::whereIn('area_id', $areas)->pluck('branch_name');
                    return $query->whereIn('b.branch_name', $branches);
                })
            ->orderBy('t.id')
            ->get();

        // dd($transactions);

            // ->chunk(2500, function($transactions) use ($spreadsheet, &$row, &$with_transaction, $request) { // READ AND USE $row
                // if($request->product) {
                //     $transactions = $transactions->whereIn('type', $request->product);
                // }
                // if($request->branch) {
                //     // $transactions = $transactions->whereIn('userbranch', $request->branch);
                //     $transactions = $transactions->whereIn('b.branch_name', $request->branch);
                // }
                // if($request->area) {
                //     $branches = Branch::whereIn('area_id', $request->area)->pluck('branch_name');
                //     // $transactions = $transactions->whereIn('userbranch', $branches);
                //     $transactions = $transactions->whereIn('b.branch_name', $branches);
                // }
                // if($request->region) {
                //     $areas = Area::whereIn('region_id', $request->region)->pluck('id');
                //     $branches = Branch::whereIn('area_id', $areas)->pluck('branch_name');
                //     // $transactions = $transactions->whereIn('userbranch', $branches);
                //     $transactions = $transactions->whereIn('b.branch_name', $branches);
                // }

                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'Detailed Report for '.Carbon::createFromFormat('Y-m-d', $request->date_from)->format('m/d/Y').' - '.Carbon::createFromFormat('Y-m-d', $request->date_to)->format('m/d/Y'));
                $sheet->setCellValue('A2', 'Date and Time Generated: '.Carbon::now()->format('m/d/Y H:i:s'));
                $sheet->setCellValue('A3', 'Generated By: '.auth()->user()->full_name);
                $sheet->setCellValue('A4', 'COI Number');
                $sheet->setCellValue('B4', 'Policy Number');
                $sheet->setCellValue('C4', 'Insured Name');
                $sheet->setCellValue('D4', 'Type');
                $sheet->setCellValue('E4', 'Units');
                $sheet->setCellValue('F4', 'Price');
                $sheet->setCellValue('G4', 'Date Issued');
                $sheet->setCellValue('H4', 'Status');
                $sheet->setCellValue('I4', 'Posted');
                $sheet->setCellValue('J4', 'User Branch');
                $sheet->setCellValue('K4', 'User Name');
                $sheet->setCellValue('L4', 'Date/Time Created');

                foreach($transactions as $transaction)
                {
                    $with_transaction = true;
                    $sheet->setCellValue('A'.$row, $transaction->coi_number);
                    $sheet->setCellValue('B'.$row, $transaction->policy_number);
                    $sheet->setCellValue('C'.$row, str_replace('=', '', $transaction->insured_name));
                    $sheet->setCellValue('D'.$row, CommonController::getTransactionType($transaction->type));
                    $sheet->setCellValue('E'.$row, $transaction->units);
                    $sheet->setCellValue('F'.$row, $transaction->price);
                    $sheet->setCellValue('G'.$row,  Carbon::parse($transaction->date_issued)->format('m/d/Y'));
                    $sheet->setCellValue('H'.$row, $transaction->status);
                    $sheet->setCellValue('I'.$row, $transaction->posted);
                    // $sheet->setCellValue('J'.$row, $transaction->userbranch);
                    $sheet->setCellValue('J'.$row, $transaction->branch_name);
                    $sheet->setCellValue('K'.$row, $transaction->username);
                    $sheet->setCellValue('L'.$row, Carbon::parse($transaction->created_at)->format('m/d/Y H:i:s'));
                    $row++;
                }
                // dd($transaction->getQueryString());
            // });
        if($with_transaction) {
            $writer = new Xlsx($spreadsheet);
            // if(strpos(url()->current(), 'public') !== false) $public = '../';
            // else $public = '';
            // $result = $writer->save($public.'public/storage/downloads/'.$file_name);
            // $result = $writer->save('public/storage/downloads/'.$file_name);
            $result = $writer->save(public_path('storage/downloads/').$file_name);
            session([
                'download' => $file_name,
                'success' => 'File Created Successfully'
            ]);
        } else {
            session(['error' => 'No records found']);
        }
        return redirect()->route('detailed.index');
    }

    public function show($id) { }
    public function edit($id) { }
    public function update(Request $request, $id) { }
    public function destroy($id) { }
}




// $sheet->setCellValue('A1', 'KPT Number');
// $sheet->setCellValue('B1', 'COI Number');
// $sheet->setCellValue('C1', 'Policy Number');
// $sheet->setCellValue('D1', 'BOS Entry Number');
// $sheet->setCellValue('E1', 'Ticket Number');
// $sheet->setCellValue('F1', 'Insured Name');
// $sheet->setCellValue('G1', 'Address');
// $sheet->setCellValue('H1', 'Civil Status');
// $sheet->setCellValue('I1', 'Beneficiary');
// $sheet->setCellValue('J1', 'Relationship');
// $sheet->setCellValue('K1', 'Date of Birth');
// $sheet->setCellValue('L1', 'Guardian 1');
// $sheet->setCellValue('M1', 'Guardian 1 Date of Birth');
// $sheet->setCellValue('N1', 'Guardian 2');
// $sheet->setCellValue('O1', 'Guardian 2 Date of Birth');
// $sheet->setCellValue('P1', 'Child / Siblings 1');
// $sheet->setCellValue('Q1', 'Child / Siblings 1 Date of Birth');
// $sheet->setCellValue('R1', 'Child / Siblings 2');
// $sheet->setCellValue('S1', 'Child / Siblings 2 Date of Birth');
// $sheet->setCellValue('T1', 'Child / Siblings 3');
// $sheet->setCellValue('U1', 'Child / Siblings 3 Date of Birth');
// $sheet->setCellValue('V1', 'Child / Siblings 4');
// $sheet->setCellValue('Q1', 'Child / Siblings 4 Date of Birth');
// $sheet->setCellValue('X1', 'Type');
// $sheet->setCellValue('Y1', 'Units');
// $sheet->setCellValue('Z1', 'Date Issued');
// $sheet->setCellValue('AA1', 'Time Issued');
// $sheet->setCellValue('AB1', 'Status');
// $sheet->setCellValue('AC1', 'Posted');
// $sheet->setCellValue('AD1', 'User Created');
// $sheet->setCellValue('AE1', 'User Branch');
// $sheet->setCellValue('AF1', 'Reason');