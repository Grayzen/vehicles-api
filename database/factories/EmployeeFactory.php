<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        $name = $this->faker->firstName;
        $surname = $this->faker->lastName;
        // $company = mt_rand(1, Company::count());
        // $companyName = preg_replace('/[ ,]+/', '', Company::where('id', $company)->value('name'));
        // $email = strtolower("$name.$surname@$companyName.com");

    	return [
            // 'company_id' => $company,
    	    'name' => $name,
            'surname' => $surname,
            'email' => strtolower("$name.$surname@abc.com"),
    	];
    }
}
