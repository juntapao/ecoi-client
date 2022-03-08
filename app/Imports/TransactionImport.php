<?php

namespace App\Imports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;


class TransactionImport implements ToModel,WithHeadingRow,WithMultipleSheets
{
    use WithConditionalSheets;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            
            'coi_number'       => $row['coi_number'],
            'policy_number'    => $row['policy_number'],
            'insured_name'     => $row['insured_name'],
            'bos_entry_number' => $row['bos_entry_number'],
            'ticket_number'    => $row['ticket_number'],
            'insured_name'     => $row['insured_name'],
            'address'          => $row['address'],
            'civil_status'     => $row['civil_status'],
            'beneficiary'      => $row['beneficiary'],
            'relationship'     => $row['relationship'],
            'dateofbirth'      => $row['dateofbirth'],
            'guardian'         => $row['guardian'],

            'guardian_dateofbirth'       => $row['guardian_dateofbirth'],
            'guardian2'                  => $row['guardian2'],
            'guardian_dateofbirth2'      => $row['guardian_dateofbirth2'],
            'child_siblings'             => $row['child_siblings'],
            'child_siblings_dateofbirth' => $row['child_siblings_dateofbirth'],

            'child_siblings2'             => $row['child_siblings2'],
            'child_siblings_dateofbirth2' => $row['child_siblings_dateofbirth2'],  
            'child_siblings3'             => $row['child_siblings3'],
            'child_siblings_dateofbirth3' => $row['child_siblings_dateofbirth3'],  
            'child_siblings4'             => $row['child_siblings4'],
            'child_siblings_dateofbirth4' => $row['child_siblings_dateofbirth4'],

            'type'  => $row['type'],
            'units' => $row['units'],
            'price' => $row['price'],
            'date_issued' => $row['date_issued'],
            'time_issued' => $row['time_issued'],  
            'status' => $row['status'],
            'posted' => $row['posted'], 

            'userid_created'  => $row['userid_created'],
            'userbranch'      => $row['userbranch'],   
            'reason'          => $row['reason'],
            'userid_modified' => $row['userid_modified'],  
            'created_at'      => $row['created_at'],
            'updated_at'      => $row['updated_at'],
        ]); 
    } 

    public function conditionalSheets(): array
    {
        return [
            'Family Protect Plus' => new TransactionImport(),
            'Pinoy Protect Plus' => new TransactionImport(),
            'Family Protect' => new TransactionImport(),
            'Pawners Protect' => new TransactionImport(),
            'Kwarta Padala Protect' => new TransactionImport(),
        ];
    }
}
