<?php

namespace App\Http\Controllers\Api\Onboarding;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Onboarding;
use Illuminate\Http\Request;

class OnboardController extends ResponseController
{
      public function viewAll()
      {
        $onboarding = Onboarding::simplePaginate(15);
        return $this->sendResponse($onboarding);
      }



}
