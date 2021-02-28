<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use File;

class CariBengkelController extends Controller
{
    public function mobil(){
        return view('cari-bengkel.mobil.kota');
    }

    public function daerahMobil(){
        $brands = Brand::all();
        return view('cari-bengkel.mobil.brand', ['brands' => $brands]);
    }

    public function motor(){
        return view('cari-bengkel.motor.kota');
    }

    public function daerahMotor(){
        $brands = Brand::all();
       
        return view('cari-bengkel.motor.brand', ['brands' => $brands]);
    }

}
