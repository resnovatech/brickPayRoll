<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'employee_id','overtime_date','overtime_hour','overtime_pay','description'
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
