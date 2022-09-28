<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        User::factory()->count(1)->create();
        // Company::factory()->count(5)->create();
        Employee::factory()->count(15)->create()->each(function($employee){
            $employee->vehicle()->save(Vehicle::factory()->make());
        });
        Vehicle::factory()->count(10)->create();
    }
}
