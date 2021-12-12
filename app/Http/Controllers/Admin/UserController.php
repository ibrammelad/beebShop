<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Admin\ActivityLogController;
use function Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  protected $model;

  public function __construct(){
    $this->model = new User();

      $this->middleware(['role_or_permission:super admin|view_user|modify_user'])->only('index' ,'showAdmins');
      $this->middleware(['role_or_permission:super admin|modify_user'])->except('index');

  }

  public function index()
  {
    $users = User::withCount('roles')->has('roles',0)->paginate(20);
    return view('admin.pages.users.index',compact('users'));
  }

  public function showAdmins()
  {
    $users = User::withCount('roles')->has('roles',1)->paginate(20);
    return view('admin.pages.users.indexAdmin',compact('users'));
  }

  public function create()
  {
    $roles = Role::all();
    return view('admin.pages.users.create',compact('roles'));
  }

  public function store(StoreUserRequest $request)
  {
    try {
      DB::beginTransaction();
      $input = $request->except('_token' , 'password');

      if ($request->hasFile('image')) {
        $image = $request->image;
        $new_name = Str::random(12).'.'.$image->getClientOriginalExtension();
        $image->move(public_path("images/users"), $new_name);
        $input['image'] = $new_name;
      }

      $input['password'] = Hash::make($request->password);
      $user = User::Create($input);
      $x = 0 ;
      if ($request->roles != null) {
        $user->assignRole($request->input('roles'));
        $x = 1;
      }
      ActivityLog::create([
        'log_name' => 'User',
        'description' =>"add User with name ". $user->name,
        'causer' => auth()->user()->id,
        'subject' => 'Add'
      ]);
      DB::commit();
      if ($x == 0) {
        return redirect()->route('users.index')->with(['success' => "add successfully"]);
      }
    elseif ($x == 1) {
      return redirect()->route('showAdmin')->with(['success' => "add successfully"]);
    }
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->route('users.create')->with(['error' => "some error try again"]);
    }
  }

  public function edit(User $user)
  {
    $roles = Role::all();
    return view('admin.pages.users.edit',compact('user','roles'));
  }

  public function update(Request $request, User $user)
  {
    try {
      $reules=[
        'email' => 'required|max:55',
        'name'  =>  'required',
        'image' => 'image|mimes:jpeg,png,jpg' ,
        'phone' => 'required',

      ];
      $this->validate($request, $reules);

          DB::beginTransaction();
          $data = $request->except('_token');
          if ($data['password'] == '') {
            $data['password'] = $user->password;
          } else {
            $data['password'] = Hash::make($data['password']);
          }
          if($request->hasFile('image')) {
              $image = $user->image;
              $image = public_path('images/users/' . $image);
              if ($image==null) {
                unlink($image);// delete photo from directory
              }
              $image1 = $request->image;
              $new_name = Str::random(12).'.'.$image1->getClientOriginalExtension();
              $image1->move(public_path("images/users"), $new_name);
              $data['image'] = $new_name;
          }
          $user->update($data);
          DB::table('model_has_roles')->where('model_id', $user->id)->delete();
          $x = 0 ;
          if ($request->roles != null) {
              $user->assignRole($request->input('roles'));
              $x= 1;
            }
          ActivityLog::create([
            'log_name' => 'User',
            'description' => "update User with name " . $user->name,
            'causer' => auth()->user()->id,
            'subject' => 'Edit'
          ]);
          DB::commit();
            if ($x == 0) {
              return redirect()->route('users.index')->with(['success' => "add successfully"]);
            }
            elseif ($x == 1) {
              return redirect()->route('showAdmin')->with(['success' => "add successfully"]);
            }
          } catch (\Exception $exception) {
          DB::rollback();
          $this->validate($request, $reules);
          return redirect()->route('users.edit' , $user)->with(['errors' => "some error try again"]);
        }

  }

  public function destroy(User $user)
  {
    try {
      DB::beginTransaction();
      if ($user->image != null) {
        $image = $user->image;
        $imagee = public_path('images/users/' . $image);  // get the path of basic app
        if ($image != null)
        {
          unlink($imagee);// delete photo from directory
        }
      }
      $user->delete();
      ActivityLog::create([
        'log_name' => 'User',
        'description' =>"delete User with name ". $user->name,
        'causer' => auth()->user()->id,
        'subject' => 'Delete'
      ]);
      DB::commit();
        return redirect()->route('users.index')->with(['success' => "deleted successfully"]);

    } catch (\Exception $exception) {

      DB::rollBack();
      return redirect()->route('users.index')->with(['error' => "some error occur "]);;

    }
  }
}

