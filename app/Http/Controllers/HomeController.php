<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Bengkel;
use App\UserBengkelFav;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $brands = Brand::all();
        $bengkels = Bengkel::all();
            foreach($bengkels as $bengkel){
                $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                ->select('brands.nama')
                ->get();
                foreach($specialities as $key => $value){
                    $bengkel->{'specialties'. $key} = $value->nama;
                }

                $bengkel->fav = UserBengkelFav::where('id_bengkel', $bengkel->id)->get()->count();
            }
        
        
        
        return view('index', ['brands' => $brands, 'bengkels' => $bengkels]);
    }
}
