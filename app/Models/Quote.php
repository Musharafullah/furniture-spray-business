<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory,HasUuids;

    protected $guarded = [];
    // protected $fillable = [
    //     'client_id',
    //     'user_id',
    //     'product_id',
    //     'width',
    //     'height',
    //     'sqm',
    //     'product_price',
    //     'matt_finish',
    //     'spraying_edges',
    //     'metallic_paint',
    //     'wood_stain',
    //     'gloss_80',
    //     'gloss_100_paint',
    //     'gloss_100_acrylic_lacquer',
    //     'polyester',
    //     'burnished_finish',
    //     'barrier_coat',
    //     'edgebanding',
    //     'micro_bevel',
    //     'routed_handle_spraying',
    //     'beaded_door',
    //     'quantity',
    //     'net_price',
    //     'vat',
    //     'trade_discount',
    //     'total_gross',



    // ];
    // client realtion with user
    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    // store the id of this user whos create the quote
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
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
