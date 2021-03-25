<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananTowing extends Model
{
    //
    protected $table = 'pesanan_towings';

    protected $fillable = [
        'id', 'id_pemesan', 'nama_pemesan', 'no_hp', 'alamat', 'time' , 'date', 'id_bengkel_tujuan','status'
    ];
}
