<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserKeranjang extends Model
{
    //
    public function userpesanan(){
	    return $this->belongsTo('App\UserPesanan','id_pesanan', 'id');
	}
}
