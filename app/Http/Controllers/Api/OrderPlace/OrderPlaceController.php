<?php

namespace App\Http\Controllers\Api\OrderPlace;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\OrderPlace;
use Illuminate\Http\Request;

class OrderPlaceController extends ResponseController
{
    public function OrderPlace()
    {
      $places  =  OrderPlace::Active()->simplePaginate(15);
      return $this->sendResponse($places);
    }
}
