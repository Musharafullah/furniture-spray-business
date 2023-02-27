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
        'user_id',
        'delivery_distance',
        'delivery_option',
        'delivery_charges',
        'collected',
        'delivered',
        'survey',
        'bevel_edges',
        'comment',
        'status',
        //
        'matt_finish',
        'spraying_edges',
        'paint_metallic_paint',
        'wood_stain',
        'paint_80_Gloss',
        'paint_100_Gloss',
        'Gloss_100_acrylic_lacquer',
        'polyester',
        'burnished',
        'barrier_coat',
        'edgebanding_rate',
        'paint_micro_bevel',
        'routed_j',
        'beaded_door',

    ];
    public function User()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    // relation with
    // relation with quote
    public function Deals()
    {
        return $this->hasMany(Deals::class);
    }
}
