<?php

namespace App\Http\Controllers\Api\Banner;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends ResponseController
{
  public function getBanners()
  {
      $banners = Banner::active()->simplePaginate(15);
      return $this->sendResponse($banners);
    }
}
