<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPesanan extends Model
{
    //
    public function user(){
	    return $this->belongsTo('App\User','id_user', 'id');
	}

    public function userkeranjang(){
	    return $this->hasMany('App\UserKeranjang','id_pesanan', 'id');
	}
}
