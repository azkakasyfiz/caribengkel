<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserKeranjang extends Model
{
    //

    protected $table = 'user_keranjangs';

    protected $fillable = [
        'quantity'
    ];


    public function userpesanan(){
	    return $this->belongsTo('App\UserPesanan','id_pesanan', 'id');
	}
    public function pesanan(){
	    return $this->belongsTo('App\BengkelProduct');
	}
}
