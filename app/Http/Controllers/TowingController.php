<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserWishlist;
use App\UserKeranjang;
use App\UserBengkelFav;
use App\BengkelProduct;
use App\Bengkel;
use App\SparepartCategories;
use App\User;
use App\UserPesanan;
use App\PesananTowing;
use Illuminate\Support\Facades\DB;
use Auth;

class TowingController extends Controller
{
    //
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

        $pesanan = UserPesanan::where('id_user', Auth::id())->get() ->first();

        return view('client_area.keranjang', ['keranjangs' => $keranjang, 'pesanans' => $pesanan]);
    }

    public function pesanTowing()
    {

        $bengkel = Bengkel::select('id','nama_bengkel')->get();
        return view('client_area.pesan_towing', ['bengkels' => $bengkel]);
    }

    public function addPesananTowing(Request $request)
    {

        $request->validate([
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'time' => 'required',
            'date' => 'required',
            'id_bengkel_tujuan' => 'required'
        ]);

        //dd($request);

        PesananTowing::create([
            'id_pemesan' => Auth::id(),
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'date' => $request->date,
            'time' => $request->time,
            'id_bengkel_tujuan' => $request->id_bengkel_tujuan,
            'status' => 'Menunggu Konfirmasi'
        ]);
        //dd($request);
        return redirect('/pesantowing/berhasil')->with('alert', 'Berhasil memesan towing!');
    }

    public function adminTowing()
    {
        $pesanan_towing = PesananTowing::all();
        //dd($pesanan_towing);

        foreach($pesanan_towing as $towing){

            $user = User::where('id', '=', $towing->id_pemesan)->first();
            $bengkel = Bengkel::where('id', '=', $towing->id_bengkel_tujuan)->first();
            $towing->id = $towing->id;
            $towing->id_pemesan = $user->name;
            $towing->nama_pemenan = $towing->nama_pemesan;
            $towing->no_hp = $towing->no_hp;
            $towing->alamat = $towing->alamat;
            $towing->date = $towing->date;
            $towing->time = $towing->time;
            $towing->id_bengkel_tujuan = $bengkel->nama_bengkel;
            $towing->status = $towing->status;
        }

        //dd($towing);

        return view('towing.dashboard_towing', ['pesanan_towings' => $pesanan_towing]);
    }

    public function accTowing($id){
        $towing = PesananTowing::where('id', '=', $id)->first();
        $towing->status = 'Menuju Lokasi';
        //dd($towing);

        $towing->save();

        return redirect()->back()->with('alert', 'Silakan bersiap menuju lokasi towing!');

    }

    public function decTowing($id){
        $towing = PesananTowing::where('id', '=', $id)->first();
        $towing->status = 'Maaf kami belum bisa menuju lokasi';
        //dd($towing);

        $towing->save();

        return redirect()->back()->with('alert', 'Berhasil menolak pesanan towing!');

    }

    public function payTowing($id){
        $towing = PesananTowing::where('id', '=', $id)->first();
        $towing->status = 'Pembayaran terverifikasi';
        //dd($towing);

        $towing->save();

        return redirect()->back()->with('alert', 'Berhasil menyetujui pesanan towing!');

    }

    public function statusTowing()
    {
        $pesanan_towing = PesananTowing::all()->where('id_pemesan', '=', Auth::id());
        //dd($pesanan_towing);

        foreach($pesanan_towing as $towing){
            $bengkel = Bengkel::where('id', '=', $towing->id_bengkel_tujuan)->first();
            $towing->id = $towing->id;
            $towing->nama_pemenan = $towing->nama_pemesan;
            $towing->no_hp = $towing->no_hp;
            $towing->alamat = $towing->alamat;
            $towing->date = $towing->date;
            $towing->time = $towing->time;
            $towing->id_bengkel_tujuan = $bengkel->nama_bengkel;
            $towing->status = $towing->status;
        }

        //dd($towing);

        return view('client_area.status_towing', ['pesanan_towings' => $pesanan_towing]);
    }

    public function checkoutTowing(){
        $towing = PesananTowing::where('id_pemesan', Auth::id())->get()->last();
        $bengkel = Bengkel::where('id', $towing->id_bengkel_tujuan)->first();

        return view('client_area.checkout_towing', ['towings' => $towing, 'bengkels' => $bengkel]);
    }
}
