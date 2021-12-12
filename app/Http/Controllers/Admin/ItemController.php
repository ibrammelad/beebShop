<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Imports\ItemsImport;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Item;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ItemController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|view_item|modify_item'])->only('index');
    $this->middleware(['role_or_permission:super admin|modify_item'])->except('index');
  }
    public function index()
    {
        $items = Item::paginate(20);
        $provider = Provider::first();
        return view('admin.pages.items.index',compact('items' , 'provider'));
    }


    public function create()
    {
      $provider = Provider::first();
      $categories = Category::active()->get();
        return view('admin.pages.items.create' , compact('categories' ,'provider'));
    }


    public function store(StoreItemRequest $request)
    {

      try {
            DB::beginTransaction();
            $input = $request->all();
            $image = $request->image;
            $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
            $image->move(public_path("images/items"), $new_name);
            $input['image'] = $new_name;
            $item = Item::create($input);
            ActivityLog::create([
              'log_name' => 'Item',
              'description' =>"add Item with name ". $item->name,
              'causer' => auth()->user()->id,
              'subject' => 'Add'
            ]);

            DB::commit();
            return redirect()->route('items.index')->with(['success'=>"add item successfully"]);
          }
          catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('items.create')->with(['errors' => "some error try again"]);
          }
    }



    public function edit(Item $item)
    {

      $categories = Category::active()->get();
      $provider = Provider::first();

      return view('admin.pages.items.edit',compact('item' , 'categories' ,'provider'));
    }


    public function update(Request $request, Item $item)
    {
      try {
        DB::beginTransaction();
        $input = $request->except('_token');
        if ($request->hasFile('image')) {
          $image = $item->image;
          $image = public_path('images/items/' . $image);  // get the path of basic app
          if (!empty($image)) {
            unlink($image);
          }// delete photo from directory
          $image1 = $request->file('image');
          $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
          $image1->move(public_path("images/items"), $new_name);
          $input['image'] = $new_name;
        }
        $item->update($input);
        ActivityLog::create([
          'log_name' => 'Items',
          'description' =>"update Item with name ". $item->name,
          'causer' => auth()->user()->id,
          'subject' => 'Edit'
        ]);
        DB::commit();
        return redirect()->route('items.index')->with(['success' =>"update successfully"]);
      }
      catch (\Exception $exception)
      {
        DB::rollBack();
        return redirect()->route('items.edit')->with(['errors' =>"some error occur "]);

      }
    }


    public function destroy($id)
    {
      try {
        $item = Item::findOrFail($id);
        DB::beginTransaction();
        if ($item->image != null) {
          $image = $item->image;
          $imagee = public_path('images/items/' . $image);  // get the path of basic app
          if ($image != null){
            unlink($imagee);// delete photo from directory
          }
        }
        $item->delete();
        ActivityLog::create([
          'log_name' => 'Item',
          'description' =>"delete Item with name ". $item->name,
          'causer' => auth()->user()->id,
          'subject' => 'Delete'
        ]);
        DB::commit();
        return redirect()->route('items.index')->with(['success' =>"deleted successfully"]);
      }
      catch (\Exception $exception)
      {

        DB::rollBack();
        return redirect()->route('items.index')->with(['error' =>"some error occur "]);

      }
    }



    public function import(Request $request)
    {
      try {
        $validator = Validator::make(
          [
            'file'      => $request->file,
            'extension' => strtolower($request->file->getClientOriginalExtension()),
          ],
          [
            'file'          => 'required',
            'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
          ]
        );
        if ($validator->fails())
        {
          return redirect()->route('items.create')->with(['error'=>"file is not excel sheet , please choose correct file"]);
        }
        $excel = $request->file('file');
        $import = new ItemsImport();
        $import->import($excel);
        return redirect()->route('items.index')->with(['success'=>"add item successfully"]);
      }
      catch (\Maatwebsite\Excel\Validators\ValidationException $exception  )
      {
        $errors = $exception->failures();
        $xError =   $errors[0]->errors();
        $items = Item::paginate(20);
        return view('admin.pages.items.index',compact('items' , 'xError'));
      }

    }



}
