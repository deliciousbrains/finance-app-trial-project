<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\Transaction as TransactionResource;
use App\Http\Requests\StoreTransactionRequest;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();
        $saved = $this->transactionService->store($validated);

        return (new TransactionResource($saved))
            ->response()
            ->setStatusCode(201);
    }

    public function update(StoreTransactionRequest $request, $id)
    {
        $validated = $request->validated();
        $saved = $this->transactionService->update($validated, $id);

        return (new TransactionResource($saved))
            ->response()
            ->setStatusCode(201);
    }

    public function destroy($id)
    {
        $this->transactionService->delete($id);
        return response()->json(null, 204);
    }
}
