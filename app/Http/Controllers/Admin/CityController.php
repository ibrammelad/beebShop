<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_city|modify_city'])->only('index');
    $this->middleware(['role_or_permission:super admin|permission:modify_city'])->except('index');  }
    public function index()
    {
      $cities = City::paginate(20);
      return view('admin.pages.cities.cities', compact('cities'));
    }

    public function create()
    {
       $areas = Area::active()->get();
      return view('admin.pages.cities.cities-form' , compact('areas'));

    }

    public function store(Request $request)
    {
      $this->validate($request , [
        'name' => 'required|max:255',
        'area_id' => 'required|exists:areas,id',
        'cost'=>'required|numeric',
        'status' => 'required|in:0,1',
      ]);
      $data = $request->except('_token');
      City::create($data);
      return redirect()->route('city_index')->with(['success' => 'City added successfully']);
    }

  public function edit($id)
  {
    $city = City::findOrFail($id);
    $areas =Area::all();
    return view('admin.pages.cities.cities-edit', compact('city' , 'areas'));


  }

  public function update(Request  $request , $id)
  {
    $city = City::findOrFail($id);
    $data = $request->except('_token');
    $city->update($data);
    return redirect()->route('city_index')->with(['success' => 'City updated successfully']);

  }

  public function destroy($id)
  {
    $city = City::findOrFail($id);
    $city->delete();
    return redirect()->route('city_index')->with(['success' => 'City deleted successfully']);


  }

}
