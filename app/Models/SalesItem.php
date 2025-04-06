<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    protected $table = "sales_item";
    protected $primaryKey = "sales_item_id";
    public $timestamps = false;
}
