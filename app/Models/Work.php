<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Work extends Authenticatable
{
  use HasFactory, Notifiable , HasApiTokens;

//    protected $guard = 'work';

    protected $guarded = [];

    protected $hidden = [
      'password',
    ];

  public  function scopeActiveDriver($query)
  {
    return $query->where('is_driver' , 1);
  }

  public function orderPlace()
  {
    return $this->belongsTo(OrderPlace::class , 'order_place' , 'id');
  }
  public function city()
  {
    return $this->belongsTo(City::class , 'city_id' , 'id');
  }

  public function workTime()
  {
    return $this->hasMany(WorkTime::class);
  }

  public function order()
  {
    return $this->hasMany(Order::class , 'delivery_id' , 'id');
  }

  public function debit()
  {
    return  $this->hasOne(Debit::class , 'work_id' , 'id');
  }

  public function review()
  {
    return $this->hasMany(Review::class, 'work_id' , 'id');
  }
}
