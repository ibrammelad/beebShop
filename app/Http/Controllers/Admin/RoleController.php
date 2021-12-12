<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
  public function __construct()
  {
    $this->middleware(['role_or_permission:super admin|make_role']);
  }
    public function index()
    {

      $users = User::withCount('roles')->has('roles',1)->get();
//      return $users;
      return view('admin.pages.roles.index-user-roles',compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.pages.roles.create-user-roles', compact('users' , 'roles'));
    }


  public function store(Request $request)
  {


    try {
//          $this->validate($request, $rules);
//         return $request;
          $user = User::findOrfail($request->user_id);
          $role = Role::findOrfail($request->role);

          if ($user->roles != null) {
            \Illuminate\Support\Facades\DB::table('model_has_roles')->where('model_id', $user->id)->delete();
          }
          if ($request->permissions != null) {
            $permissions = array_keys($request->permissions);
            $user->assignRole($role->name);
            $user->syncPermissions($permissions);

          } else {

            $user->assignRole($role->name);

          }
          return redirect('/admin/roles')->with(['success' => "add Roles and permissions successfully"]);
        } catch (\Exception $exception) {

               //return $exception->getMessage();

          return redirect('/admin/roles')->with(['error' => "error add Roles and permissions successfully"]);
    }

  }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        $role = \Spatie\Permission\Models\Role::where('id','=',$id)->first();
        return view('admin.pages.roles.edit-user-roles',compact('role'));

    }


//    public function update(Request $request,\Spatie\Permission\Models\Role $role)
//    {
//        //
//        //
//        $data = $request->all();
//        $old_name = $role->name;
//
//
//
//      request()->validate([
//			'name' => 'required|string|min:3|max:120|unique:roles,name,' . $role->id,
//        ]);
//
//        $permissions = array_keys($data['permissions']);
//
//
//            if( $old_name != $data['name'] ){
//
//                $role->delete();
//                $role = Role::create(['name' => $data['name']]);
//
//            }
//
//
//           $role->syncPermissions($permissions);
//
//           return redirect('/admin/roles');
//
//    }


    public function destroy($id)
    {
      \Illuminate\Support\Facades\DB::table('model_has_roles')->where('model_id', $id)->delete();
      $user =User::findOrFail($id);
      $permissions = $user->permissions;
      foreach ($permissions as $permission)
      {
        $user->revokePermissionTo($permission->name);

      }

      return redirect('/admin/roles')->with(['success'=>"roles and permissions deleted from user successfully"]);
    }
}
