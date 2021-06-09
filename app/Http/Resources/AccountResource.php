<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $processedTransactions = $this->transactions()->simplePaginate(5);
        return [
            'account_id' => $this->id,
            'balance' => $this->balance,
            'processedTransactions' => $processedTransactions,
        ];
    }
}
