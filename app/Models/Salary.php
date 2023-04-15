<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;


    protected $fillable = [
        'admin_id', 'employee_id','date_of_joining','employee_category','gross_salary','basic_fifty_percentage_of_gross','house_rent_fifty_percentage_of_basic','medical_fifteen_percentage_of_basic','convenience_ten_percentage_of_basic','food_fifteen_percentage_of_basic','other_allow','bank_name','bank_account_number'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
