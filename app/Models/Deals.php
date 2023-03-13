<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable =
    // [
    //     'quote_id',
    //     'product_id',
    //     'width',
    //     'height',
    //     'sqm',
    //     'product_price',
    //     'cutout',
    //     'notch',
    //     'hole',
    //     'back_select',
    //     'finish',
    //     'cnc',
    //     'sandblasted',
    //     'ritec',
    //     'quantity',
    //     'net_price',
    //     'vat',
    //     'trade_discount',
    //     'total_gross',
    // ];
    // relation with

    public function quotes()
    {
        return $this->belongsTo(Quote::class,'quote_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
