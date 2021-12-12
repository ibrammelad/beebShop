<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Debit;
use App\Models\FinancialWork;
use App\Models\User;

use App\Models\Work;
use Illuminate\Http\Request;
use Intervention\Image\Gd\Driver;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_user|modify_user'])->only('profile');
  }
    public function profile($id)
    {
      $driver = Work::findOrFail($id);
      $debits = Debit::where('work_id' , $id)->first();
      $financial = FinancialWork::where('work_id' , $id) ->get();
      $orders = $driver ->order;
      return view('admin.pages.profile.profile', compact('driver' ,'orders','financial','debits'));

    }


  public function payAll($id)
  {
      $debit = Debit::where('work_id' , $id)->first();
      $debit->update([
        "payable" => 0 ,
      ]);
     return redirect()->route('profile_route', $id)->with(['success'=>'driver pay all payable money for him']);

  }
  public function payPart(Request  $request , $id)
  {
      $amount = $request->amount;
      $debit = Debit::where('work_id' , $id)->first();
      if ($amount > $debit->payable)
      {
        return redirect()->route('profile_route', $id)->with(['error'=>'amount is big than must pay']);
      }
      $payable = $debit->payable - $amount;
      $debit->update([
        "payable" => $payable ,
      ]);
     return redirect()->route('profile_route', $id)->with(['success'=>'driver pay part of payable money for him']);

  }

}
