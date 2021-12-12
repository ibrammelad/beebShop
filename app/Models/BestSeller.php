<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    use HasFactory;

    protected $fillable = [
      'item_id' , 'frequency'
    ];

  public function item()
  {
    return $this->belongsTo(Item::class);
    }
}
