<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable=[
        'manufacturer_name', 'cnpj'
    ];
}
