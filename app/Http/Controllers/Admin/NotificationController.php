<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|send_notification']);
  }
  public function index()
  {
    return view('admin.pages.notification.notification');

  }
}
