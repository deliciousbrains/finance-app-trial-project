<?php

namespace App\Imports;

use Auth;
use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionsImportExcel implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = Auth::user();
        $transaction = new Transactions();
        $transaction->user_id=$user->id;
        $transaction->label=$row['label'];
        $transaction->amount=$row['value'];
        $transaction->date=date("Y-m-d H:i:s",strtotime($row['date']));
        $transaction->save();
        return $transaction;
    }
}
