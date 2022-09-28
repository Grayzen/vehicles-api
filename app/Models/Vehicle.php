<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'vehicle_type', 'vin', 'registration_no', 'type', 'fuel', 'brand', 'model', 'year'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


}
