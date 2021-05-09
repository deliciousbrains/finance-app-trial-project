<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Force JSON responses for all requests
     *
     * @return bool
     */
    public function wantsJson()
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string',
            'amount' => 'required|regex:/-?\d+(\.\d{2})?/',
            'date' => 'date',
        ];
    }
}
