<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BengkelProduct extends Model
{
    //
    protected $table = 'bengkel_products';

    protected $fillable = [
        'id_bengkel', 'id_categories', 'nama_product', 'quantity', 'harga' , 'kendaraan', 'picUrl'
    ];
}
