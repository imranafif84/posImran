<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'photo', 'shopname'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'supplier_id', 'id');
    }
}
