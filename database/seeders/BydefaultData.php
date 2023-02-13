<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class BydefaultData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         // Reset cached roles and permissions
         app()['cache']->forget('spatie.permission.cache');

         // create permissions
         Permission::create(['name' => 'edit articles']);
         Permission::create(['name' => 'delete articles']);
         Permission::create(['name' => 'publish articles']);
         Permission::create(['name' => 'unpublish articles']);

         // create roles and assign created permissions
         $role = Role::create(['name' => 'admin']);
         $role->givePermissionTo([Permission::all()]);

         $role = Role::create(['name' => 'client']);
         $role->givePermissionTo(Permission::all());

        //  $user1 = new User;
        //  $user1->name = 'Majid Fazal';
        //  $user1->email = 'admin@gmail.com';
        //  $user1->phone = '123456789';
        //  $user1->status = 1;
        //  $user1->password = Hash::make('admin123');
        //  $user1->save();
        //  $user1->assignRole('admin');
        //
        $user1 = new User;
        $user1->name = 'Majid Fazal';
        $user1->phone = '123456789';
        $user1->email = 'majidfazal@gmail.com';
        $user1->postal_code = 'EC2A 4NE';
        $user1->address = 'rawalpindi';
        $user1->latitude = 51.523220;
        $user1->longitude = -0.084410;
        $user1->distance = 0;
        $user1->trade_discount = 0;
        $user1->password = Hash::make('admin123');
        $user1->assignRole('admin');
        $user1->save();

        $user2 = new User;
        $user2->name = 'bajwa';
        $user2->phone = '123456789';
        $user2->email = 'bajwa@gmail.com';
        $user2->postal_code = 'EC2A 4NE';
        $user2->address = 'london';
        $user2->latitude = 51.523220;
        $user2->longitude = -0.084410;
        $user2->distance = 0;
        $user2->password = Hash::make('test23');
        $user2->assignRole('client');
        $user2->save();


    }
}
