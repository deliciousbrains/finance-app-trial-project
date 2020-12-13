<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $appends = ['tdate','tdatetotal'];

    public function getTdateAttribute()
    {
        $day_group = $this->transaction_date;
        $day_group = date('D, j M', strtotime($day_group));
        if ($day_group == date('D, j M')) {
            $day_group='TODAY';
        }
        if ($day_group == date('D, j M', strtotime('-1 day'))) {
            $day_group='YESTERDAY';
        }
        return $day_group;
    }
    public function getTdatetotalAttribute()
    {
        $day_group = $this->transaction_date;
        $start = date('Y-m-d', strtotime($day_group));
        $end = date('Y-m-d', strtotime("$day_group +1 day"));

        $total=Transaction::where('transaction_date', '>=', $start)->where('transaction_date', '<', $end)->sum('amount');
        return $total;

    }
}
