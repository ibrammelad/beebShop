<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
  public function getProviders()
  {
    $provider = Provider::first();

    return view('admin.pages.providers.indexProviders' , compact('provider'));
  }

  public function storeProviders(Request $request)
  {
    $data = $request->except('_token');

    $provider = Provider::first();
    $provider->update($data);
    return redirect()->route('getProviders')->with(['success' => "update providers successfully"]);
  }

}
