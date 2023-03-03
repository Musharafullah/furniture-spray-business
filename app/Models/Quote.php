<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'client_id',
        'delivery_option',
        'collected',
        'delivered',
        'comment',
        'internal_comment',
        'hide_collect',
        'hide_delivered',
        'total_net_status',
        'total_vat_status',
        'gross_total_status',
        'net_price_status',
        'discount_status',
        'product_price_status',
        'hidden_price',
        'billing_postal_code',
        'status',
    ];
    public function User()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    public function Product()
    {
        return $this->belongsTo(User::class,'product_id');
    }
    // relation with
    // relation with quote
    public function Deals()
    {
        return $this->hasMany(Deals::class);
    }
}
