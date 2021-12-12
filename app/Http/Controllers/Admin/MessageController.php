<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_message']);
  }
    public function index()
    {
      $messages = Message::paginate(20);
      return view('admin.pages.messages.messages' , compact('messages'));
    }

    public function delete($id)
    {
      $message = Message::findOrFail($id);
      $message->delete();
      return redirect()->route('messages_index')->with(['success'=> "message is deleted successfully"]);
    }
}
