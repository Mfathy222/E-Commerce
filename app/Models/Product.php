<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','image','price','compare_price','category_id','featured','store_id','category_id','options','rating',
        'featured','status'
    ];
}
