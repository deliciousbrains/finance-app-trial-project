<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->createOrUpdate($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        return $this->createOrUpdate($request, $transaction);
    }


    /**
     * Create or Update a Transaction model instance.
     *
     * @param Request $request
     * @param Transaction $transaction
     */
    private function createOrUpdate(Request $request, Transaction $transaction = null)
    {
        $data = $request->only(['label', 'performed_at', 'amount']);
        if ($data['performed_at']) {
            $data['performed_at'] = \Carbon\Carbon::parse($data['performed_at']);
        }

        $validator = Validator::make($data, [
            'label' => 'required',
            'performed_at' => 'required|date',
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response($validator->getMessageBag(), 422);
        } else {
            if (!$transaction) {
                $transaction = new Transaction($data);
                $transaction->user()->associate($request->user());
                $transaction->save();
            } else {
                $transaction->update($data);
            }
            return response()->json();
        }
    }
}
