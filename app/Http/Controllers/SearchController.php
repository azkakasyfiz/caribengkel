<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserBengkelFav;
use App\Bengkel;
use App\BengkelSpecialties;
use App\BengkelProduct;
use App\Brand;

class SearchController extends Controller
{
    public function bengkel(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where(function ($query) use ($cari){
                            $query->where('nama_bengkel','like', '%' . $cari . '%')
                            ->orWhere('kota','like', '%' . $cari . '%')
                            ->orWhere('alamat','like', '%' . $cari . '%')
                            ->orWhere('daerah','like', '%' . $cari . '%');
                            })
                            ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where(function ($query) use ($cari){
                            $query->where('nama_bengkel','like', '%' . $cari . '%')
                            ->orWhere('kota','like', '%' . $cari . '%')
                            ->orWhere('alamat','like', '%' . $cari . '%')
                            ->orWhere('daerah','like', '%' . $cari . '%');
                            })
                            ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where(function ($query) use ($cari){
                        $query->where('nama_bengkel','like', '%' . $cari . '%')
                        ->orWhere('kota','like', '%' . $cari . '%')
                        ->orWhere('alamat','like', '%' . $cari . '%')
                        ->orWhere('daerah','like', '%' . $cari . '%');
                        })
                        ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        
        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $request->cari . '%')
                    ->orWhere('kota','like', '%' . $request->cari . '%')
                    ->orWhere('alamat','like', '%' . $request->cari . '%')
                    ->orWhere('daerah','like', '%' . $request->cari . '%')
                    ->paginate(9);
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();

                }

                else if($request->kendaraan == 'motor'){
                    $bengkels = Bengkel::where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $request->cari . '%')
                    ->orWhere('kota','like', '%' . $request->cari . '%')
                    ->orWhere('alamat','like', '%' . $request->cari . '%')
                    ->orWhere('daerah','like', '%' . $request->cari . '%')
                    ->paginate(9);
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    abort(404);
                }
            }

            else{
                $bengkels = Bengkel::where('nama_bengkel','like', '%' . $request->cari . '%')
                ->orWhere('kota','like', '%' . $request->cari . '%')
                ->orWhere('alamat','like', '%' . $request->cari . '%')
                ->orWhere('daerah','like', '%' . $request->cari . '%')
                ->paginate(9);
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();
            }
        }

        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function bengkelJaktim(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Timur')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Timur')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where('kota', '=' , 'Jakarta Timur')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Timur')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Timur')
                    ->where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }
            }

            else{
                $bengkels = Bengkel::where('kota', '=' , 'Jakarta Timur')
                ->where('nama_bengkel','like', '%' . $cari . '%')
                ->paginate(9);
                
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();

            }

        }
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function bengkelJakpus(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Pusat')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Pusat')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where('kota', '=' , 'Jakarta Pusat')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Pusat')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Pusat')
                    ->where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }
            }

            else{
                $bengkels = Bengkel::where('kota', '=' , 'Jakarta Pusat')
                ->where('nama_bengkel','like', '%' . $cari . '%')
                ->paginate(9);
                
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();

            }

        }
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function bengkelJaksel(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Selatan')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Selatan')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where('kota', '=' , 'Jakarta Selatan')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Selatan')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Selatan')
                    ->where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }
            }

            else{
                $bengkels = Bengkel::where('kota', '=' , 'Jakarta Selatan')
                ->where('nama_bengkel','like', '%' . $cari . '%')
                ->paginate(9);
                
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();

            }

        }
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function bengkelJakbar(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Barat')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Barat')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where('kota', '=' , 'Jakarta Barat')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Barat')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Barat')
                    ->where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }
            }

            else{
                $bengkels = Bengkel::where('kota', '=' , 'Jakarta Barat')
                ->where('nama_bengkel','like', '%' . $cari . '%')
                ->paginate(9);
                
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();

            }

        }
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function bengkelJakut(Request $request){
        $supp = Brand::all();
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('mobil', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Utara')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();

                }

                else{
                    $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                        ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                        ->where('motor', '=' , '1')
                        ->where('kota', '=' , 'Jakarta Utara')
                        ->where('nama_bengkel','like', '%' . $cari . '%')
                        ->paginate(9);
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
    
                        $products = DB::table('bengkel_products')
                        ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                        ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                        ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                        ->where('nama_product','like', '%' . $request->cari . '%')
                        ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                        ->get();
                }
                    

            }

            else{
                $bengkels = BengkelSpecialties::where('id_brand', $brand->id)
                    ->join('bengkels', 'bengkels.id', '=', 'bengkel_specialties.id_bengkel')
                    ->where('kota', '=' , 'Jakarta Utara')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
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

                    $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
            }
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Utara')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }

                else{
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Utara')
                    ->where('motor', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->paginate(9);
                    
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
            
                    $products = DB::table('bengkel_products')
                                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                                ->where('nama_product','like', '%' . $request->cari . '%')
                                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                                ->get();
                }
            }

            else{
                $bengkels = Bengkel::where('kota', '=' , 'Jakarta Utara')
                ->where('nama_bengkel','like', '%' . $cari . '%')
                ->paginate(9);
                
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
        
                $products = DB::table('bengkel_products')
                            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                            ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                            ->where('nama_product','like', '%' . $request->cari . '%')
                            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                            ->get();

            }

        }
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products, 'supp' => $supp]);
    }

    public function sparepart(Request $request){
        $supp = Brand::all();
        if(isset($request->brand)){
            if(isset($request->kendaraan)){
                $products = DB::table('bengkel_products')->where('bengkel_products.kendaraan', '=', $request->kendaraan)
                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                ->where('brands.nama','like', '%' . $request->brand . '%')
                ->where('nama_product','like', '%' . $request->cari . '%')
                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                ->paginate(9);
            }
            else{
                $products = DB::table('bengkel_products')
                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                ->where('brands.nama','like', '%' . $request->brand . '%')
                ->where('nama_product','like', '%' . $request->cari . '%')
                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                ->paginate(9);
            }
        }

        else{
            if(isset($request->kendaraan)){
                $products = DB::table('bengkel_products')->where('bengkel_products.kendaraan', '=', $request->kendaraan)
                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                ->where('nama_product','like', '%' . $request->cari . '%')
                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                ->paginate(9);
            }
            else{
                $products = DB::table('bengkel_products')
                ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                ->where('nama_product','like', '%' . $request->cari . '%')
                ->orWhere('sparepart_categories.nama','like', '%' . $request->cari . '%')
                ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                ->paginate(9);
            }
        }
        
        return view('search.sparepart', ['products' => $products, 'supp' => $supp]);
    }
}
