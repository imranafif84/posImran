<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'category_id', 'id');
    }
}
