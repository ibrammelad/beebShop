<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use Illuminate\Http\Request;

class PointsController extends Controller
{

  public function getPoints()
  {
    $point  = Point::first();
    return view('admin.pages.points.points' ,compact('point'));
  }

  public function storePoints(Request $request)
  {
    $this->validate($request , [
      'equal' => "required|numeric",
      'order' => "required|numeric",
      'register' => "required|numeric"
    ]);
    $data = $request->except('_token');
    $point = Point::first();
    $point->update($data);
    return redirect()->route('getPoints')->with(['success' => "update value of point"]);
  }
}
