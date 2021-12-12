<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function getBanners()
    {
      $banners = Banner::active()->paginate(15);
      return view('admin.pages.banners.indexBanners' , compact('banners'));
    }

    public function addBanners()
    {
      return view('admin.pages.banners.createBanner' );

    }
    public function StoreBanner(Request  $request)
    {
        $rules = [
          'photo' => 'required|mimes:jpeg,png,jpg,gif',
          'type' => 'required',
          'status' => 'required|in:0,1'
        ];
        $this->validate($request,$rules);
        $data = $request->except('_token', 'photo');
        if ($request->hasFile('photo')) {
          $image = $request->photo;
          $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
          $image->move(public_path("images/Banners"), $new_name);
          $data['photo'] = $new_name;
        }
        Banner::create($data);
        return redirect()->route('getBanners')->with(['success' => "Banner is added successfully"]);
    }

    public function destroyBanner($id)
    {
      $banner =Banner::findOrFail($id);
      if ($banner->photo != null)
      {
        $imageBanner = $banner->photo;
        $path = public_path('images/Banners/'.$imageBanner);
        if ($imageBanner != null)
        {
          unlink($path);
        }
      }
      $banner->delete();
      return redirect()->route('getBanners')->with(['success' => "Banner is deleted successfully"]);
    }
}
