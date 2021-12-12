<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ActivityLogController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_category|modify_category'])->only('index');
    $this->middleware(['role_or_permission:super admin|modify_category'])->except('index');
  }

  public function index()
  {
    $categories = Category::paginate(20);
    return view('admin.pages.categories.index', compact('categories'));
  }


  public function create()
  {
    return view('admin.pages.categories.create');
  }


  public function store(StoreCategoryRequest $request)
  {
    try {
      DB::beginTransaction();
      $input = $request->all();
      $image = $request->file('image');
      $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
      $image->move(public_path("images/categories"), $new_name);
      $input['image'] = $new_name;
      $category = Category::Create($input);
      ActivityLog::create([
        'log_name' => 'category',
        'description' => "add category with name " . $category->name,
        'causer' => auth()->user()->id,
        'subject' => 'Add'
      ]);
      DB::commit();
      return redirect()->route('categories.index')->with(['success' => "add successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('categories.create')->with(['error' => "some error try again"]);
    }
  }


  public function show(Category $category)
  {
    //
  }


  public function edit(Category $category)
  {
    return view('admin.pages.categories.edit', compact('category'));
  }


  public function update(Request $request, Category $category)
  {
    try {
      DB::beginTransaction();
      $input = $request->except('_token');
      if ($request->hasFile('image')) {
        $image = $category->image;
        $imagee = public_path('images/categories/' . $image);  // get the path of basic app
        if (!empty($image)) {
          unlink($imagee);
        }// delete photo from directory
        $image1 = $request->file('image');
        $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
        $image1->move(public_path("images/categories"), $new_name);
        $input['image'] = $new_name;
      }
      $category->update($input);
      ActivityLog::create([
        'log_name' => 'category',
        'description' => "update category with name " . $category->name,
        'causer' => auth()->user()->id,
        'subject' => 'Edit'
      ]);
      DB::commit();
      return redirect()->route('categories.index')->with(['success' => "updated successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('categories.edit' ,$category->id)->with(['error' => "some error occur "]);;

    }
  }


  public function destroy(Category $category)
  {
    try {
      DB::beginTransaction();
      if ($category->image != null) {
        $image = $category->image;
        $imagee= public_path('images/categories/' . $image);  // get the path of basic app
        if ($image != null) {
          unlink($imagee);
        }// delete photo from directory
      }
      $category->delete();
      ActivityLog::create([
        'log_name' => 'category',
        'description' => "delete category with name " . $category->name,
        'causer' => auth()->user()->id,
        'subject' => 'Delete'
      ]);
      DB::commit();
      return redirect()->route('categories.index')->with(['success' => "deleted successfully"]);
    } catch (\Exception $exception) {
      DB::rollBack();
      return $exception->getMessage();
      return redirect()->route('categories.index')->with(['error' => "some error occur "]);;

    }

  }
}
