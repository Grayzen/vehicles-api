<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
    	$this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));
        $v = $this->faker->vehicleArray();

            return [
                'employee_id'       => NULL,
                // 'vehicle_type'      => 'car',
                'vin'               => $this->faker->vin,
                'registration_no'   => $this->faker->vehicleRegistration,
                'type'              => $this->faker->vehicleType,
                'fuel'              => $this->faker->vehicleFuelType,
                'brand'             => $v['brand'],
                'model'             => $v['model'],
                'year'              => $this->faker->biasedNumberBetween(1998, date('Y'), 'sqrt'),
            ];
    }
}
