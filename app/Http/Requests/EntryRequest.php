<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'label' => 'required|string',
            'value' => 'required|regex:/\d+?\.\d{2}/',
            'date' => 'date',
        ];
    }
}
