<?php

namespace App\Models;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'product_name',
        'product_image_path',
        'cost_from_supplier',
        'sale_net_sqm',
        'matt_finish',
        'min_sqm',
        'spraying_edges',
        'metallic_paint',
        'wood_stain',
        'gloss_80',
        'gloss_100_paint',
        'gloss_100_acrylic_lacquer',
        'polyester_or_full_grain',
        'burnished_finish',
        'edgebanding',
        'micro_bevel',
        'product_note',
        'routed_handle_spraying',
        'beaded_door',
        'barrier_coat',
    ];
    // relation with quote
    public function deals()
    {
        return $this->hasMany(Deals::class);
    }

}
