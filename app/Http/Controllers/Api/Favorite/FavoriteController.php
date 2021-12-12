<?php

namespace App\Http\Controllers\Api\Favorite;

use App\Http\Controllers\Api\ResponseController;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends ResponseController
{

  public function getMyFavorite()
  {
    $user_id = auth()->user()->id;
    $myFavorites = Favorite::where("user_id", $user_id)->with("item")->get();
    return $this->sendResponse($myFavorites);
  }

  public function addFavorite(Request $request)
  {
    $rules = [
      "item_id" => 'required|exists:items,id',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return $this->sendError("404", [$validator->errors()]);
    }
    $data = $request->all();
    $data['user_id']= auth()->user()->id;
    $favorite = Favorite::create($data);
    return $this->sendResponse($favorite);

  }

  public function deleteFavorite($id)
  {
    $fav = Favorite::findOrFail($id);
    $fav->delete();
    return response()->json(['data' => "successfully ", 'success' => true], 200);
  }
}
