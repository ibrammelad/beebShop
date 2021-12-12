<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activities_log';

    protected $fillable=[
      'log_name',	'description',	'subject',	'causer',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'causer');
    }
//
//    public function subject()
//    {
//        return $this->morphTo(__FUNCTION__, 'subject_type', 'subject_id')->withTrashed();
//    }
}
