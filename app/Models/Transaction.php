<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'value', 'date', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
