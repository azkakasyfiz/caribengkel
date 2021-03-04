<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    //
    protected $table = 'bengkels';

    protected $fillable = [
        'id', 'id_pemilik', 'nama_bengkel', 'telp', 'daerah', 'kota' , 'alamat', 'motor', 'mobil'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
