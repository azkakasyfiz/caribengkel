<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    //
    protected $table = 'bengkels';

    protected $fillable = [
        'id', 'id_pemilik', 'nama_bengkel', 'telp', 'daerah', 'kota' , 'alamat', 'location', 'motor', 'mobil', 'open_hour', 'close_hour', 'picUrl', 'subPic'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
