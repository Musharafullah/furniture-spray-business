<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;


    protected $guarded = [];
    // client realtion with user
    // store the id of this user whos create the quote
    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    // relation with quote
    public function deals()
    {
        return $this->hasMany(Deals::class);
    }
}
