<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'min_delivery_charges',
        'min_survey_and_fitting_charges',
    ];
}
