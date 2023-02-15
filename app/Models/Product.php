<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'type',
        'code',
        'product_name',
        'product_image_path',
        'cost_from_supplier',
        'sale_net_sqm',
        'cut_out',
        'notch',
        'hole',
        'painted',
        'sparkle_finish',
        'metallic_finish',
        'rake',
        'printed',
        'cnc',
        'standblasted',
        'ritec',
        'radius_corners',
        'product_note',
        'bevel_edges',
    ];
}
