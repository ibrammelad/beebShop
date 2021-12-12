<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPlace extends Model
{
    use HasFactory;

    protected $fillable=[
      'name', 'status' , 'cost'
    ];

  public  function scopeActive($query)
  {
    return $query->where('status' , 1);
  }
}
