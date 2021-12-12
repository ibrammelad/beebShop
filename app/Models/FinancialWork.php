<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialWork extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function order()
    {
      return $this->belongsTo(Order::class, 'order_id' , 'id');
    }

    public function work()
    {
      return $this->belongsTo(Work::class , 'work_id' , 'id');
    }
}
