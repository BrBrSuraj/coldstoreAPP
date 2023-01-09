<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Local;
use App\Models\Customer;
use App\Models\Purchese;
use App\Models\Supplier;
use App\Models\SalePayment;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::withoutEvents(function(){
            User::create([
                'role_id' => 1,
                'name' => 'Subash Kattel',
                'email' => 'subashkattel@gmail.com',
                'phone' => '9855043870',
                'address' => 'Hetauda 7, Nagsoti',
                'password' => \bcrypt('password'),
            ]);
            // ->each(function ($user) {
                // Local::factory(5)->create([
                //     'user_id' => $user->id,
                //     'credit'=>0,
                // ]);

                // Supplier::factory(5)->create([
                //     'user_id' => $user->id,
                // ])->each(function ($supplier) {
                //     Purchese::factory(1)->create([
                //         'supplier_id' => $supplier->id,
                //         'user_id' => $supplier->user_id,
                //     ]);
                // });

                // Customer::factory(5)->create([
                //     'user_id' => $user->id,
                // ])->each(function ($customer) {
                //     Sale::factory(1)->create([
                //         'customer_id' => $customer->id,
                //         'user_id' => $customer->user_id,
                //     ]);
                // });
            // });

        });

        User::withoutEvents(
            function () {
                User::create([
                    'role_id' => 2,
                    'name' => 'Saroj Dulal',
                    'email' => 'sdulal@gmail.com',
                    'phone' => '9855077183',
                    'address' => 'Hetauda 8, kamane',
                    'password' => \bcrypt('password'),
                ]);
                // ->each(function ($user) {
                //     Local::factory(5)->create([
                //         'user_id' => $user->id,
                //         'credit' => 0,
                //     ]);
                    // Supplier::factory(5)->create([
                    //     'user_id' => $user->id,
                    // ])->each(function ($supplier) {
                    //     Purchese::factory(1)->create([
                    //         'supplier_id' => $supplier->id,
                    //         'user_id' => $supplier->user_id,
                    //     ]);
                    // });


                    // Customer::factory(5)->create([
                    //     'user_id' => $user->id,
                    // ])->each(function ($customer) {
                    //     Sale::factory(1)->create([
                    //         'customer_id' => $customer->id,
                    //         'user_id' => $customer->user_id,
                    //     ]);
                    // });
                // });
            });

       
    }
}
