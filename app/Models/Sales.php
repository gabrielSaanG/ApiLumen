<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Sales extends Model
{
    //
//    public Date $sales_date;
    public $timestamps = false;

    protected $primaryKey = 'sale_id';

    protected $fillable=[
        'sale_date'
    ];
}
