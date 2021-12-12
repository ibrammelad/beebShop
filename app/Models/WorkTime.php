<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    use HasFactory;
    protected $guarded=[];

  public function worker()
  {
    return $this->belongsTo(Work::class,'worker_id', 'id');
  }
}
