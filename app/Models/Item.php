<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item_sale';
    protected $fillable = ['item_code', 'item_name', 'quantity', 'expired_date', 'note'];
}
