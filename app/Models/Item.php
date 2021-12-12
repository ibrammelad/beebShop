<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_offer','description','quantity_type','pricebypoint', 'quantity','price','discount','status' , 'image' , 'category_id'
    ,'cost1' , 'cost2' ,'cost3'

    ];


      public function category()
      {
        return $this->belongsTo(Category::class);
      }

      public  function scopeActive($query)
      {
        return $query->where('status' , 1);
      }
}
