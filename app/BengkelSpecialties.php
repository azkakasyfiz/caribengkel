<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BengkelSpecialties extends Model
{
    protected $table = 'bengkel_specialties';

    protected $fillable = [
        'id_bengkel', 'id_brand'
    ];
}
