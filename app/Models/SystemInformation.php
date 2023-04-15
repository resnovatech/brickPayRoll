<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo', 'icon', 'System_Name','Phone','Email','Address'
    ];
}
