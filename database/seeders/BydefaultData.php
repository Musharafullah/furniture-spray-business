<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DeliveryCharges;

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
        $user1->name = 'Admin';
        $user1->phone = '123456789';
        $user1->email = 'admin@gmail.com';
        $user1->postal_code = 'EC2A 4NE';
        $user1->address = 'rawalpindi';
        $user1->latitude = 51.523220;
        $user1->longitude = -0.084410;
        $user1->distance = 0;
        $user1->trade_discount = 0;
        $user1->password = Hash::make('admin123');
        $user1->assignRole('admin');
        $user1->save();

        $user1 = new User;
        $user1->name = 'Admin';
        $user1->phone = '123456789';
        $user1->email = 'office@roka-spray.com';
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
        $user2->name = 'Admin';
        $user2->phone = '123456789';
        $user2->email = 'kamal@roka-spray.com';
        $user2->postal_code = 'EC2A 4NE';
        $user2->address = 'rawalpindi';
        $user2->latitude = 51.523220;
        $user2->longitude = -0.084410;
        $user2->distance = 0;
        $user2->trade_discount = 0;
        $user2->password = Hash::make('admin123');
        $user2->assignRole('admin');
        $user2->save();

        $user3 = new User;
        $user3->name = 'Admin';
        $user3->phone = '123456789';
        $user3->email = 'admin@rbc-london.com';
        $user3->postal_code = 'EC2A 4NE';
        $user3->address = 'rawalpindi';
        $user3->latitude = 51.523220;
        $user3->longitude = -0.084410;
        $user3->distance = 0;
        $user3->trade_discount = 0;
        $user3->password = Hash::make('admin123');
        $user3->assignRole('admin');
        $user3->save();

        $user4 = new User;
        $user4->name = 'user1';
        $user4->phone = '123456789';
        $user4->email = 'user1@gmail.com';
        $user4->postal_code = 'EC2A 4NE';
        $user4->address = 'london';
        $user4->latitude = 51.523220;
        $user4->longitude = -0.084410;
        $user4->distance = 0;
        $user4->password = Hash::make('test23');
        $user4->assignRole('client');
        $user4->save();

        // create DeliveryCharges seeder
        $deleivery1 = new DeliveryCharges();
        $deleivery1->total_charges = 100;
        $deleivery1->save();

    }
}
