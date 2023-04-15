<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;


    protected $fillable = [
        'admin_id', 'bank_name','branch','account_number'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}
