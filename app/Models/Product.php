<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class product extends Model
{
    use HasFactory;
    // protected $fillable=[
    //     'name','slug','image','price','compare_price','category_id','featured','store_id','category_id','options','rating',
    //     'featured','status'
    // ];
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope());

    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
