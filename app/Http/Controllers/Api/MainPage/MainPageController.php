<?php

namespace App\Http\Controllers\Api\MainPage;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\BestSeller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Point;
use Illuminate\Http\Request;

class MainPageController extends ResponseController
{
      public function Main()
      {
        $categories = Category::simplePaginate(15);
        $bestoffer = Item::active()->where('discount' ,'>', 1)
          ->orderBy('discount' , 'desc')
          ->simplePaginate(15);
        $is_offer = Item::active()->where('is_offer' , 1)->simplePaginate(15);
         //best seller
        $bestSeller = BestSeller::with('item')
          ->orderBy('frequency' , 'desc')
        ->simplePaginate(15);

        $success['categories'] = $categories;
        $success['Is_offer'] = $is_offer;
        $success['bestoffer'] = $bestoffer;
        $success['bestSeller'] = $bestSeller;
        return $this->sendResponse($success);

      }

      public function points()
      {
        $points['user_points'] = auth()->user()->points;
        return $this->sendResponse($points);

      }

      public function replacePoints(Request $request)
      {
        $rules = [
          'pointsReplace' => "required|numeric"
        ];
        $this->validate($request , $rules);
        $points = auth()->user()->points;
        if ($request->pointsReplace >= $points)
        {
          return $this->sendError("404" , "you don't have that number of points you have ".$points." point");
        }
        $point = Point::first();
        $data["money"] = ($request->pointsReplace)/$point->equal;
        $data["points_now"] = $points - $request->pointsReplace;
          auth()->user()->update([
            "points" => $data["points_now"]
          ]);
        return $this->sendResponse($data);
      }
}
