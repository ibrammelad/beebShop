<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends ResponseController
{

      public function index()
      {
        $categories = Category::Active()->simplePaginate(15);
        return $this->sendResponse($categories);
      }

      public function show($id)
      {
        $category = Category::active()->where('id' , $id)->simplePaginate(15);
        return $this->sendResponse($category);
      }

      public function CategoryItems($id)
      {
        $category = Category::active()->with('items')->where('id' , $id)->simplePaginate(15);
        return $this->sendResponse($category);

      }
}
