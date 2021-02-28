<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bengkel;
use App\BengkelSpecialties;
use App\BengkelProduct;
use App\Brand;

class SearchController extends Controller
{
    public function bengkel(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('mobil', '=', '1')
                        ->where(function ($query) use ($cari){
                        $query->where('nama_bengkel','like', '%' . $cari . '%')
                        ->orWhere('kota','like', '%' . $cari . '%')
                        ->orWhere('alamat','like', '%' . $cari . '%')
                        ->orWhere('daerah','like', '%' . $cari . '%');
                        })

                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('motor', '=', '1')
                        ->where(function ($query) use ($cari){
                        $query->where('nama_bengkel','like', '%' . $cari . '%')
                        ->orWhere('kota','like', '%' . $cari . '%')
                        ->orWhere('alamat','like', '%' . $cari . '%')
                        ->orWhere('daerah','like', '%' . $cari . '%');
                        })

                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    
                    $bengkels = Bengkel::where('id', $b->id_bengkel)
                        ->where(function ($query) use ($cari){
                            $query->where('nama_bengkel','like', '%' . $cari . '%')
                            ->orWhere('kota','like', '%' . $cari . '%')
                            ->orWhere('alamat','like', '%' . $cari . '%')
                            ->orWhere('daerah','like', '%' . $cari . '%');
                        })
                        ->get();
                        
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        
        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $request->cari . '%')
                    ->orWhere('kota','like', '%' . $request->cari . '%')
                    ->orWhere('alamat','like', '%' . $request->cari . '%')
                    ->orWhere('daerah','like', '%' . $request->cari . '%')
                    ->get();
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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

        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function bengkelJaktim(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Timur')
                        ->where('mobil', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Timur')
                        ->where('motor', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Timur')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Timur')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function bengkelJakpus(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Pusat')
                        ->where('mobil', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Pusat')
                        ->where('motor', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Pusat')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Pusat')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function bengkelJaksel(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Selatan')
                        ->where('mobil', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Selatan')
                        ->where('motor', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Selatan')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Selatan')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function bengkelJakbar(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Barat')
                        ->where('mobil', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Barat')
                        ->where('motor', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Barat')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Barat')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function bengkelJakut(Request $request){
        $cari = $request->cari;
        if(isset($request->brand)){ //kalau ada nama brand
            $brand = Brand::where('nama','like', '%' . $request->brand . '%')->first();
            $bengkelWBrand = BengkelSpecialties::where('id_brand', $brand->id)->get();
            foreach($bengkelWBrand as $b){
                if(isset($request->kendaraan)){
                    if($request->kendaraan == 'mobil'){
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Utara')
                        ->where('mobil', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                        $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Utara')
                        ->where('motor', '=', '1')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
                    $bengkels = Bengkel::where('id', '=', $b->id_bengkel)
                        ->where('kota', '=' , 'Jakarta Utara')
                        ->where('nama_bengkel','like', '%' . $request->cari . '%')
                        ->get();
                        foreach($bengkels as $bengkel){
                            $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                            ->select('brands.nama')
                            ->get();
                            foreach($specialities as $key => $value){
                                $bengkel->{'specialties'. $key} = $value->nama;
                            }
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
            
        }

        else{
            if(isset($request->kendaraan)){
                if($request->kendaraan == 'mobil'){
                    $bengkels = Bengkel::where('kota', '=' , 'Jakarta Utara')
                    ->where('mobil', '=', '1')
                    ->where('nama_bengkel','like', '%' . $cari . '%')
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                    ->get();
                    
                    foreach($bengkels as $bengkel){
                        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                        ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                        ->select('brands.nama')
                        ->get();
                        foreach($specialities as $key => $value){
                            $bengkel->{'specialties'. $key} = $value->nama;
                        }
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
                ->get();
                
                foreach($bengkels as $bengkel){
                    $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
                    ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
                    ->select('brands.nama')
                    ->get();
                    foreach($specialities as $key => $value){
                        $bengkel->{'specialties'. $key} = $value->nama;
                    }
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
        
        
        return view('search.bengkel', ['bengkels' => $bengkels, 'products' => $products]);
    }

    public function sparepart(Request $request){

        $products = DB::table('bengkel_products')
                    ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
                    ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
                    ->join('bengkels', 'bengkels.id','bengkel_products.id_bengkel')
                    ->where('nama_product','like', '%' . $request->cari . '%')
                    ->orWhere('brands.nama','like', '%' . $request->cari . '%')
                    ->orWhere('sparepart_categories.nama','like', '%' . $request->cari . '%')
                    ->orWhere('bengkels.nama_bengkel','like', '%' . $request->cari . '%')
                    ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkels.nama_bengkel','bengkel_products.*')
                    ->get();
        
        return view('search.sparepart', ['products' => $products]);
    }
}
