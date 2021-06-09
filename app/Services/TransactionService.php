<?php

namespace App\Services;

use App\Models\Transaction;

use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function store($validRequest)
    {
        $trans = Transaction::create($validRequest);

        return $trans;
    }

    public function import($data)
    {
        Transaction::create($data);
    }

    public function update($validRequest, $id)
    {
        $trans = Transaction::findOrFail($id);
        $trans->label = $validRequest['label'];
        $trans->value = $validRequest['value'];
        $trans->date = $validRequest['date'];
        $trans->processed = $validRequest['processed'];
        $trans->save();

        return $trans;
    }

    public function updateAfterImport($jobParent)
    {
        DB::transaction(function() use ($jobParent) {
            Transaction::where('jobid', $jobParent)
            ->notProcessed()
            ->update(['processed' => 1]);

            $account = Transaction::where('jobid', $jobParent)->first()->account;
            $newBalance = Transaction::where('processed', 1)->sum('value');
            $account->balance = $newBalance;
            $account->save();
        });
    }

    public function delete($id)
    {
        $trans = Transaction::findOrFail($id);
        $trans->delete();
    }

}
