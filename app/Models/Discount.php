<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable=
      [
        'id' , 'item_id',	'amount'	,'is_available'
      ];


    public function item()
    {
      return $this->belongsTo(Item::class , 'item_id' , 'id');
    }
    public function getIs_available()
    {
        return $this->is_available == 1 ? 'Yes' : 'No' ;
    }

}
