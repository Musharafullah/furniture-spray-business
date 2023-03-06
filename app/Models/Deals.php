<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory,HasUuids;

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

    public function Quotes()
    {
        return $this->belongsTo(Quotes::class,'client_id');
    }
}
