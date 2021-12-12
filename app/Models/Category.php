<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'sort', 'status' , 'image'];

  public  function scopeActive($query)
  {
    return $query->where('status' , 1);
  }

  public function items()
  {
    return $this->hasMany(Item::class);

  }
}
