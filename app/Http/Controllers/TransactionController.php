<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Resources\Transaction as TransactionResource;
use App\Http\Requests\StoreTransactionRequest;
use App\Services\AccountService;

class TransactionController extends Controller
{
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function show($id)
    {
        return new TransactionResource(Transaction::findOrFail($id));
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $trans = Transaction::create($validated);
        return (new TransactionResource($trans))
            ->response()
            ->setStatusCode(201);
    }

    public function update(StoreTransactionRequest $request, $id)
    {
        $validated = $request->validated();

        $trans = Transaction::findOrFail($id);
        $trans->label = $validated['label'];
        $trans->value = $request['value'];
        $trans->date = $request['date'];
        $trans->save();

        return (new TransactionResource($trans))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy($id)
    {
        $trans = Transaction::findOrFail($id);
        $trans->delete();

        return response()->json(null, 204);
    }
}
