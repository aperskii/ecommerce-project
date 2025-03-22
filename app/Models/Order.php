<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['qty', 'total', 'delivered_at', 'user_id', 'coupon_id'];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}
