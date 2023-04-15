<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'department_name','department_status'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function designations()
    {
        return $this->hasMany(Designations::class);
    }
}
