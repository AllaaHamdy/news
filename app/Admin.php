<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='users';
    protected $fillable = [
        'name', 'mobile', 'password','country_code','country_name'
    ];
}
