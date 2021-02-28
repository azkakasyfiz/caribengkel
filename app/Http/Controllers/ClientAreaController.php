<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserWishlist;
use App\UserBengkelFav;
use App\BengkelProduct;
use App\Bengkel;
use Illuminate\Support\Facades\DB;
use Auth;

class ClientAreaController extends Controller
{
    public function wishlist(){
        $wishlist = UserWishlist::where('id_user', Auth::id())->get();
       
        foreach($wishlist as $wish){
            $product = BengkelProduct::where('bengkel_products.id', '=', $wish->id_product)
            ->join('bengkels', 'bengkels.id', 'bengkel_products.id_bengkel')
            ->select('bengkels.nama_bengkel', 'bengkel_products.*')
            ->first();

            $wish->harga = $product->harga;
            $wish->nama_bengkel = $product->nama_bengkel;
            $wish->id_bengkel = $product->id_bengkel;
            $wish->quantity = $product->quantity;
            $wish->nama_product = $product->nama_product;
            $wish->picUrl = $product->picUrl;
        }
        
        return view('client_area.wishlist', ['wishlists' => $wishlist]);
    }

    public function addWishlist($id_product){
        $wishlist = new UserWishlist;
        $wishlist->id_user = Auth::id();
        $wishlist->id_product = $id_product;

        $wishlist->save();

        return redirect()->back()->with('alert', 'Berhasil menambahkan wishlist!');

    }

    public function deleteWishlist($id_product){
        $wishlist = UserWishlist::where('id_product', '=', $id_product)
        ->where('id_user', '=', Auth::id())->first();

        $wishlist->delete();

        return redirect('/wishlist')->with('alert', 'Berhasil menghapus wishlist!');
    }

    public function bengkelFav(){
        $bengkels = UserBengkelFav::where('id_user', Auth::id())
        ->join('bengkels', 'bengkels.id' , '=', 'user_bengkel_favs.id_bengkel')
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
        return view('client_area.bengkel-favorit', ['bengkels' => $bengkels]);
    }

    public function addToFav($id_bengkel){
        $fav = new UserBengkelFav;
        $fav->id_bengkel = $id_bengkel;
        $fav->id_user = Auth::id();

        $fav->save();

        return redirect()->back()->with('alert', 'Berhasil menambahkan bengkel ke Favorit!');
    }

    public function deleteFav($id_bengkel){
        $fav = UserBengkelFav::where('id_bengkel', '=', $id_bengkel)
        ->where('id_user', '=', Auth::id())
        ->first();

        $fav->delete();

        return redirect('/bengkel-favorit')->with('alert', 'Berhasil menghapus bengkel dari favorit!');
    }
}
