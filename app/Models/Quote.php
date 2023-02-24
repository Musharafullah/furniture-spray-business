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
