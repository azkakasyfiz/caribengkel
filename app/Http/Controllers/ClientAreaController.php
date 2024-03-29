<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserWishlist;
use App\UserKeranjang;
use App\UserBengkelFav;
use App\BengkelProduct;
use App\Bengkel;
use App\SparepartCategories;
use App\BengkelSpecialties;
use App\User;
use App\UserPesanan;
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

    public function keranjang(){
        $keranjang = UserKeranjang::where('id_user', Auth::id())->get();

        foreach($keranjang as $cart){
            $product = BengkelProduct::where('bengkel_products.id', '=', $cart->id_product)
            ->join('bengkels', 'bengkels.id', 'bengkel_products.id_bengkel')
            ->select('bengkels.nama_bengkel', 'bengkel_products.*')
            ->first();

            $cart->harga = $product->harga;
            $cart->nama_bengkel = $product->nama_bengkel;
            $cart->id_bengkel = $product->id_bengkel;
            $cart->quantity = $cart->quantity;
            $cart->nama_product = $product->nama_product;
            $cart->picUrl = $product->picUrl;
        }
        //dd($keranjang);
        $pesanan = UserPesanan::where('id_user', Auth::id())->get() ->first();

        return view('client_area.keranjang', ['keranjangs' => $keranjang, 'pesanans' => $pesanan]);
    }

    public function addKeranjang($id_product){

        if ($keranjang = UserKeranjang::where('id_product', '=', $id_product)->where('id_user', '=', Auth::id())->first()) {
            return redirect()->back()->with('alert', 'Produk yang anda pilih sudah ada dalam keranjang!');
        }

        $keranjang = new UserKeranjang;
        $keranjang->id_user = Auth::id();
        $keranjang->id_product = $id_product;
        $keranjang->quantity = "1";

        $keranjang->save();

        if ($pesanan = UserPesanan::where('id_user', '=', Auth::id())->first()) {
            $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
            $pesanan->total_harga = $pesanan->total_harga+$barang->harga*$keranjang->quantity;

            $pesanan->update();
        }

        $pesanan = new UserPesanan;
        $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
        $pesanan->id_user =  $keranjang->id_user;
        $pesanan->status = "0";
        $pesanan->total_harga = "0";
        $pesanan->total_harga = $pesanan->total_harga+$barang->harga*$keranjang->quantity;

        $pesanan->save();

        return redirect()->back()->with('alert', 'Berhasil menambahkan ke keranjang!');

        /*if ($pesanan = UserPesanan::where('id_user', '=', $pesanan->id_user)->first()) {
            $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
            $pesanan->total_harga = $pesanan->total_harga+$barang->harga*$keranjang->quantity;

            $keranjang->update();
        }

        $pesanan = new UserPesanan;
        $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
        $pesanan->id_user =  $keranjang->id_user;
        $pesanan->status = "0";
        $pesanan->total_harga = "0";
        $pesanan->total_harga = $pesanan->total_harga+$barang->harga*$keranjang->quantity;

        $pesanan->update();*/

        //$keranjang->save();

        //return redirect()->back()->with('alert', 'Berhasil menambahkan ke keranjang!');

    }

    public function addPlusKeranjang($id_product){
        $keranjang = UserKeranjang::where('id_product', '=', $id_product)
        ->where('id_user', '=', Auth::id())->first();
        $keranjang->quantity = $keranjang->quantity+1;

        $keranjang->save();

        $pesanan = UserPesanan::where('id_user', '=', Auth::id())->first();
        $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
        //$pesanan->total_harga = $pesanan->total_harga-($barang->harga*$keranjang->quantity);
        $pesanan->total_harga = $pesanan->total_harga + $barang->harga;

        $pesanan->update();

        return redirect()->back()->with('alert', 'Berhasil menambahkan jumlah barang!');

    }

    public function addMinusKeranjang($id_product){
        $keranjang = UserKeranjang::where('id_product', '=', $id_product)
        ->where('id_user', '=', Auth::id())->first();
        $keranjang->quantity = $keranjang->quantity-1;

        $keranjang->save();

        $pesanan = UserPesanan::where('id_user', '=', Auth::id())->first();
        $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
        $pesanan->total_harga = $pesanan->total_harga - $barang->harga;

        $pesanan->update();

        return redirect()->back()->with('alert', 'Berhasil mengurangi jumlah barang!');

    }

    public function deleteKeranjang($id_product){
        //$keranjang = UserKeranjang::where('id_product', '=', $id_product)
        //->where('id_user', '=', Auth::id())->first();

        //$keranjang->delete();

        $keranjang = UserKeranjang::where('id_product', '=', $id_product)
        ->where('id_user', '=', Auth::id())->first();

        if ($keranjang != null) {
            $pesanan = UserPesanan::where('id_user', '=', Auth::id())->first();
            $barang = BengkelProduct::where('id', $keranjang->id_product)->first();
            $pesanan->total_harga = $pesanan->total_harga - ($keranjang->quantity*$barang->harga);

            $pesanan->update();

            $keranjang->delete();
            return redirect('/keranjang')->with('alert', 'Berhasil menghapus barang di keranjang!');
        }

        return redirect('/keranjang')->with('alert', 'Gagal menghapus barang di keranjang!');

        //return redirect('/keranjang')->with('alert', 'Berhasil menghapus barang di keranjang!');

    }

    public function AddBengkelProduct(Request $request)
    {

        $request->validate([
            'id_categories' => 'required',
            'nama_brand' => 'required',
            'nama_product' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'kendaraan' => 'required',
            'picUrl' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        //dd($request);

        // menyimpan data file yang diupload ke variabel $participant
        $picUrl = $request->file('picUrl');

        $nama_file = time() . "_" . $picUrl->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'picUrl_product';
        $picUrl->move($tujuan_upload, $nama_file);

        $bengkel = Bengkel::where('id_pemilik', '=', Auth::id())->first();

        BengkelProduct::create([
            'id_bengkel' => $bengkel->id,
            'id_categories' => $request->id_categories,
            'nama_brand' => $request->nama_brand,
            'nama_product' => $request->nama_product,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'kendaraan' => $request->kendaraan,
            'picUrl' => $nama_file
        ]);
        //dd($request);
        return redirect('/dashboard')->with('alert', 'Berhasil menambah produk!');
    }

    public function AddBengkelSpecialties(Request $request)
    {

        $request->validate([
            'id_brand' => 'required'
        ]);
        //dd($request);

        $bengkel = Bengkel::where('id_pemilik', '=', Auth::id())->first();

        BengkelSpecialties::create([
            'id_bengkel' => $bengkel->id,
            'id_brand' => $request->id_brand
        ]);
        //dd($request);
        return redirect('/inputspecialties')->with('alert', 'Berhasil menambah brand specialties!');
    }

    public function checkout(){
        $keranjang = UserKeranjang::where('id_user', Auth::id())->get();

        foreach($keranjang as $cart){
            $product = BengkelProduct::where('bengkel_products.id', '=', $cart->id_product)
            ->join('bengkels', 'bengkels.id', 'bengkel_products.id_bengkel')
            ->select('bengkels.nama_bengkel', 'bengkel_products.*')
            ->first();

            $cart->harga = $product->harga;
            $cart->nama_bengkel = $product->nama_bengkel;
            $cart->id_bengkel = $product->id_bengkel;
            $cart->quantity = $cart->quantity;
            $cart->nama_product = $product->nama_product;
            $cart->picUrl = $product->picUrl;
        }

        $pesanan = UserPesanan::where('id_user', Auth::id())->get() ->first();
        $checkout = $pesanan->total_harga; //+ $pesanans->id;
        $nomorantrian = $pesanan->id;

        return view('client_area.checkout', ['keranjangs' => $keranjang, 'pesanans' => $pesanan, 'checkouts' => $checkout, 'nomorantrians' => $nomorantrian]);
    }
}
