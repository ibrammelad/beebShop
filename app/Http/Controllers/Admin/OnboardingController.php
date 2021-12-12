<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Onboarding;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_onboardLog|modify_onboardLog'])->only('index');
    $this->middleware(['role_or_permission:super admin|modify_onboardLog'])->except('index');
  }
  public function index()
  {
    $onboardings = Onboarding::paginate(20);
    return view('admin.pages.onboarding.onboarding-content', compact('onboardings'));

  }
  public function create()
  {
    return view('admin.pages.onboarding.onboarding-content-form');

  }

  public function store(Request $request)
  {
    $this->validate($request , [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif' ,
      'place' => 'required|max:255',
      'title' => 'required|max:255',
      'description' => 'required'
    ]);

    $input = $request->except('_token' , 'image');
    if ($request->hasFile('image'))
    {
      $image = $request->image;
      $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
      $image->move(public_path("images/onboard"), $new_name);
      $input['image'] = $new_name;
    }
    Onboarding::create($input);
    return redirect()->route('index_onboarrd')->with(['success' => "Onboarding added successfully"]);

  }

  public function edit($id)
  {
    $onboard = Onboarding::findOrFail($id);
    return view('admin.pages.onboarding.onboarding-content-edit', compact('onboard'));
  }

  public function update(Request  $request , $id)
  {
    $onboard = Onboarding::findOrFail($id);
    $data = $request->except('_token', 'image');
    if($request->hasFile('image')) {
        $image = $onboard->image;
        $image = public_path('images/onboard/'.$image);
        unlink($image);// delete photo from directory
        $image1 = $request->image;

        $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
        $image1->move(public_path("images/onboard"), $new_name);
        $data['image'] = $new_name;
    }
    $onboard->update($data);
    return redirect()->route('index_onboarrd')->with(['success' => "Onboarding updated successfully"]);

  }

  public function destroy($id)
  {
    $onboard = Onboarding::findOrFail($id);
    if ($onboard->image != null) {
      $image = $onboard->image;
      $image = public_path('images/onboard/' . $image);  // get the path of basic app
      unlink($image);// delete photo from directory
    }
    $onboard->delete();
    return redirect()->route('index_onboarrd')->with(['success' => "Onboarding deleted successfully"]);
  }
}
