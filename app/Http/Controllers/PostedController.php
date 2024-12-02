<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Transaction;
use App\Branch;
use DB;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class PostedController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('status', '!=', 'deleted')
            ->where('posted', 1)
            ->where('userid_created', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('reports.posted.index', compact('transactions'));
    }

    public function create() { }

    public function store(Request $request) { }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return view('reports.posted.show', compact('transaction'));
    }

    public function edit($id) { }

    public function update(Request $request, $id) { }

    public function destroy($id) { }

    public function search(Request $request)
    {
        $transactions = Transaction::where('status', '!=', 'deleted')
            ->where('posted', 1)
            ->where('userid_created', auth()->user()->id)
            ->where(function($query) use ($request) {
                $query->where('coi_number', 'like', '%'.$request->search.'%')
                    ->orWhere('ticket_number', 'like', '%'.$request->search.'%')
                    ->orWhere('insured_name', 'like', '%'.$request->search.'%')
                    ->orWhere('type', 'like', '%'.$request->search.'%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);
        $search = $request->search;
        $transactions->appends(['search' => $search]);
        return view('reports.posted.index', compact('search', 'transactions'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'date_from' => 'required|before_or_equal:date_to',
            'date_to' => 'required|after_or_equal:date_from',
        ]);

        $transactions = Transaction::where('status', '!=', 'deleted')
            ->where('posted', 1)
            ->where('userid_created', auth()->user()->id)
            ->whereBetween('date_issued', [$request->date_from, $request->date_to])
            ->orderBy('id', 'desc')
            ->paginate(15);
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $transactions->appends([
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);
        return view('reports.posted.index', compact('date_from', 'date_to', 'transactions'));
    }

    public function extract(Request $request)
    {
        $request->validate([
            'date_from' => 'required|before_or_equal:date_to',
            'date_to' => 'required|after_or_equal:date_from',
        ]);

        $row = 2;
        $file_name = 'Posted_Report_'.auth()->user()->id.'.csv';
        $spreadsheet = new Spreadsheet();
        $with_transaction = false;

        $transactions = DB::table('transactions as t')
            ->leftJoin('users as u', 't.userid_created', '=', 'u.id')
            ->leftJoin('branches as b', 'b.id', '=', 'u.branch_id')
            ->select(['t.coi_number', 't.policy_number', 't.insured_name', 't.type', 't.units', 't.price', 
                't.date_issued', 't.status', 't.posted', 'b.branch_name', 'u.username'])
            ->where('t.status', '!=', 'deleted')
            ->where('t.posted', 1)
            ->where('t.userid_created', auth()->user()->id)
            ->whereBetween('date_issued', [$request->date_from, $request->date_to])
            ->orderBy('t.id')
            ->get();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'COI Number');
        $sheet->setCellValue('B1', 'Policy Number');
        $sheet->setCellValue('C1', 'Insured Name');
        $sheet->setCellValue('D1', 'Type');
        $sheet->setCellValue('E1', 'Units');
        $sheet->setCellValue('F1', 'Price');
        $sheet->setCellValue('G1', 'Date Issued');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Posted');
        $sheet->setCellValue('J1', 'User Branch');
        $sheet->setCellValue('K1', 'User Name');

        foreach($transactions as $transaction) {
            $with_transaction = true;
            $sheet->setCellValue('A'.$row, $transaction->coi_number);
            $sheet->setCellValue('B'.$row, $transaction->policy_number);
            $sheet->setCellValue('C'.$row, str_replace('=', '', $transaction->insured_name));
            $sheet->setCellValue('D'.$row, CommonController::getTransactionType($transaction->type));
            $sheet->setCellValue('E'.$row, $transaction->units);
            $sheet->setCellValue('F'.$row, $transaction->price);
            $sheet->setCellValue('G'.$row, $transaction->date_issued);
            $sheet->setCellValue('H'.$row, $transaction->status);
            $sheet->setCellValue('I'.$row, $transaction->posted);
            $sheet->setCellValue('J'.$row, $transaction->branch_name);
            $sheet->setCellValue('K'.$row, $transaction->username);
            $row++;
        }
        
        if($with_transaction) {
            $writer = new Csv($spreadsheet);
            $result = $writer->save(public_path('storage/').$file_name);
            session([
                'download' => $file_name,
                'success' => 'File Created Successfully'
            ]);
        } else {
            session(['error' => 'No records found']);
        }
        return redirect()->route('posted.index');
    }
}
