<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $fillable = [
    'id', 'delivery_id','address', 'place_id','city_id','user_id', 'order_cost', 'status', 'reward_points'
  ];
  protected $dates = ['create_at'];



  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function Delivery()
  {
    return $this->belongsTo(Work::class, 'delivery_id', 'id');
  }

  public function orderPlace()
  {
    return $this->belongsTo(OrderPlace::class, 'place_id', 'id');
  }
  public function city()
  {
    return $this->belongsTo(City::class, 'city_id', 'id');
  }
  public function ShoppingCart()
  {
    return $this->hasMany(ShoppingCart::class);
  }

  public function financialWork()
  {
    return $this->hasOne(FinancialWork::class , 'order_id' , 'id');
  }


}
