<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_city|modify_city'])->only('index');
    $this->middleware(['role_or_permission:super admin|modify_city'])->except('index');
  }
  public function index()
  {
    $areas = Area::paginate(20);
    return view('admin.pages.countries.countries' , compact('areas'));
  }

  public function create()
  {
    return view('admin.pages.countries.countries-form');

  }

  public function store(Request  $request)
  {
    $this->validate($request , [
      'name' => 'required|max:255',
      'status' => 'required|in:0,1'
    ]);
     $data = $request->except('_token');
     Area::create($data);
     return redirect()->route('areas_index')->with(['success' => "cities added successfully"]);
  }

  public function edit($id)
  {
    $area = Area::findOrFail($id);
    return view('admin.pages.countries.countries-edit' , compact('area'));

  }

  public function update(Request $request,$id)
  {
    $area = Area::findOrFail($id);
    $data = $request->except('_token');
    $area->update($data);
    return redirect()->route('areas_index')->with(['success' => "cities updated successfully"]);
  }

  public function destroy($id)
  {
    $area = Area::findOrFail($id);
    $area->delete();
    return redirect()->route('areas_index')->with(['success' => "cities deleted successfully"]);

  }
}
