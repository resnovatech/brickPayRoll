<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'company_name','company_address','company_phone','company_logo'
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
