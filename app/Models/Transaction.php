<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'value', 'date', 'account_id', 'processed', 'jobid'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function scopeNotProcessed($query)
    {
        return $query->where('processed', 0);
    }

    public function scopeProcessed($query)
    {
        return $query->where('processed', 1);
    }
}
