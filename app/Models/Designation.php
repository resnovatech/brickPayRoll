<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'department_id','designation_name','designation_status'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
