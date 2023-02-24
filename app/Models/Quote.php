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
        'comment',

        'status',

        //
        'wood_matt_finish',
        'wood_spraying_edges',
        'wood_stain',
        'wood_100_Gloss_acrylic_lacquer',
        'wood_polyester',
        'wood_burnished',
        'wood_dgebanding_rate',
        'wood_routed_j',
        'wood_beaded_door',
        //
        // for wood
        'paint_matt_finish',
        'paint_spraying_edges',
        'paint_metallic_paint',
        'paint_80_Gloss',
        'paint_100_Gloss',
        'paint_100_Gloss2',
        'paint_edgebanding_rate',
        'paint_micro_bevel',
        'paint_routed_j',
        'paint_beaded_door',
        'paint_bevel_edges',

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
