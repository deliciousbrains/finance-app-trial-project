<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $balance = $this->account->balance;

        return [
            'balance' => $balance,
            'id' => $this->id,
            'label' => $this->label,
            'value' => floatval($this->value),
            'date' => $this->date,
            'account_id' => $this->account_id,
        ];
    }
}
