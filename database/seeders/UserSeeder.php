<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\OrderPlace;
use App\Models\Point;
use App\Models\Provider;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = array();
      $data['email'] = 'admin@admin.com';
      $data['phone'] = '01555728026';
      $data['name'] = 'Admin';
//      $data['address'] = '15 st menia egypt';
      $data['password'] = Hash::make('123456');
      $user = User::Create($data);
      $superAdmin = Role::create(['name' => 'super admin']);
      $dataEntry = Role::create(['name' => 'data entry']);
      $admin = Role::create(['name' => 'admin']);
      $worker = Role::create(['name' => 'worker']);


      $per[0] = Permission::create(['name' => 'view_user']);
      $per[1] = Permission::create(['name' => 'modify_user']);
      $per[2] = Permission::create(['name' => 'view_category']);
      $per[3] = Permission::create(['name' => 'modify_category']);
      $per[4] = Permission::create(['name' => 'view_item']);
      $per[5] = Permission::create(['name' => 'modify_item']);
      $per[6] = Permission::create(['name' => 'view_order']);
      $per[7] = Permission::create(['name' => 'modify_order']);
      $per[8] = Permission::create(['name' => 'modify_question']);
      $per[9] = Permission::create(['name' => 'view_message']);
      $per[10] = Permission::create(['name' => 'send_notification']);
      $per[11] = Permission::create(['name' => 'make_role']);
      $per[12] = Permission::create(['name' => 'view_onboardLog']);
      $per[13] = Permission::create(['name' => 'modify_onboardLog']);
      $per[14] = Permission::create(['name' => 'view_city']);
      $per[15] = Permission::create(['name' => 'modify_city']);
      $per[16] = Permission::create(['name' => 'view_question']);
      for($x =0; $x< count($per) ; $x++)
        {
          $superAdmin->givePermissionTo($per[$x]);
        }
      $user->assignRole('super admin');

        Category::create([
          'name' => "fruit" ,
          'image' => "Category.png",
          'status'=> 1
        ]);

        OrderPlace::create([
          'name' => "near by Carrefour" ,
          'cost' => 12 ,
          'status' => 1
        ]);
        Area::create([
          'name' => "egypt" ,
          'status' => 1
        ]);
        City::create([
          'area_id' => 1 ,
          'cost' => 20,
          'name' => "cairo elmoiz" ,
          'status' => 1
        ]);

        Provider::create();
        Point::create();
    }
}
