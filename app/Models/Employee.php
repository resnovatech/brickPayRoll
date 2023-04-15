<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'employee_id','name','mobile_number','email','gender','designation_id','department','company_id','job_location','status','discontinue_date'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function overtimes()
    {
        return $this->hasMany(Overtime::class);
    }

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }
}
