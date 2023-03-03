<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = 
    [
        'quote_id',
        'product_id',
        'width',
        'height',
        'sqm',
        'product_price',
        'matt_finish',
        'spraying_edges',
        'metallic_paint',
        'wood_stain',
        'gloss_percentage',
        'gloss_100_acrylic_lacquer',
        'polyester',
        'burnished_finish',
        'barrier_coat',
        'edgebanding',
        'micro_bevel',
        'routed_handle_spraying',
        'beaded_door',
        'quantity',
        'net_price',
        'vat',
        'trade_discount',
        'total_gross',
    ];
    // relation with 
    public function Quotes()
    {
        return $this->belongsTo(Quotes::class,'client_id');
    }
}
