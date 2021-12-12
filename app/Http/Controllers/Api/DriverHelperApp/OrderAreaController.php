<?php

namespace App\Http\Controllers\Api\DriverHelperApp;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\OrderPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAreaController extends ResponseController
{
    public function showOrderPlaces()
    {
      $orderPlaces = OrderPlace::active()->simplePaginate(15);
      return $this->sendResponse($orderPlaces);

    }

    public function showCities()
    {
      $cities = City::active()->simplePaginate(15);
      return $this->sendResponse($cities);

    }
}
