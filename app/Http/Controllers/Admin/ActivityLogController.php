<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super admin|admin']);
    }


    public function logs(){
        $activity = ActivityLog::simplePaginate(20);
        return view('admin.pages.logs.index',compact('activity'));
    }

  public function logs_delete($id)
  {
    $activity = ActivityLog::find($id);
    $activity->delete();
    return redirect()->route('logs_index')->with(['success' =>"delete successfully"]);
  }
}
