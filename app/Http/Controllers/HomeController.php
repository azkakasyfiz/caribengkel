<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Brand;
use App\Bengkel;
use App\BengkelProduct;
use App\UserBengkelFav;
use App\User;
use App\UserKeranjang;
use App\UserPesanan;
use App\SparepartCategories;
use Illuminate\Support\Facades\Hash;
use Auth;

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

    public function admin()
    {
        $nama = SparepartCategories::select('id', 'nama')->get();
        $bengkel = Bengkel::select('id', 'id_pemilik', 'nama_bengkel')->get();
        $brand = Brand::select('id', 'nama')->get();
        return view('admin.input_barang', ['namas' => $nama , 'brands' => $brand , 'bengkels' => $bengkel]);


    }
    public function registeradmin()
    {
        return view('auth.register_admin');
    }

    public function registadmin(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'noHP' => ['required'],
        ]);
        //dd($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noHP' => $request->noHP,
            'role' => 'admin',
            'alamat' => NULL
        ]);
        return redirect('/registerbengkel')->with('alert', 'Berhasil mendaftarkan akun admin!');
    }

    public function registerbengkel()
    {
        return view('admin.input_bengkel');
    }

    public function registbengkel(Request $request)
    {

        $request->validate([
            'nama_bengkel' => 'required',
            'telp' => 'required',
            'daerah' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'location' => 'required',
            'motor' => 'required',
            'mobil' => 'required',
            'open_hour' => 'required',
            'close_hour' => 'required',
            'picUrl' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'subPic' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        //dd($request);

        // menyimpan data file yang diupload ke variabel $participant
        $picUrl = $request->file('picUrl');

        $nama_file = time() . "_" . $picUrl->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'picUrl_bengkel';
        $picUrl->move($tujuan_upload, $nama_file);

         // menyimpan data file yang diupload ke variabel $participant
         $subPic = $request->file('subPic');

         $nama_file2 = time() . "_" . $subPic->getClientOriginalName();

         // isi dengan nama folder tempat kemana file diupload
         $tujuan_upload2 = 'subPic_bengkel';
         $subPic->move($tujuan_upload2, $nama_file2);

        //$admin = User::where('id', '=', Auth::id())->first();

        //dd($request);

        $users = User::latest()->first();
        Bengkel::create([
            'id_pemilik' => $users->id,
            'nama_bengkel' => $request->nama_bengkel,
            'telp' => $request->telp,
            'daerah' => $request->daerah,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'location' => $request->location,
            'motor' => $request->motor,
            'mobil' => $request->mobil,
            'open_hour' => $request->open_hour,
            'close_hour' => $request->close_hour,
            'picUrl' => $nama_file,
            'subPic' => $nama_file2
        ]);
        //dd($request);
        return redirect('/login')->with('alert', 'Berhasil mendaftarkan bengkel! Silakan Login!');
    }

    public function dashboard_admin()
    {
        $bengkel = Bengkel::where('id_pemilik', Auth::id())->get() ->first();
        $product = BengkelProduct::where('id_bengkel', $bengkel->id)->get();

        return view('admin.list_barang', ['products' => $product/*, 'bengkels' => $bengkel*/]);
    }

    public function deleteProduct($id_product){
        $product = BengkelProduct::where('id', '=', $id_product)->first();

        $product->delete();

        return redirect('/dashboard')->with('alert', 'Berhasil menghapus produk!');
    }

    // public function listPesanan(){
    //     $bengkel = Bengkel::where('id_pemilik', Auth::id())->get() ->first();
    //     //dd($bengkel);
    //     $product = BengkelProduct::where('id_bengkel', '=', $bengkel->id)->get();
    //     //dd($product);
    //     //$i = 0;
    //     foreach($product as $p){
    //     $listpesanan = UserKeranjang::where('id_product', '=', $p->id)->first();
    //     //echo $listpesanan;
    //         foreach($listpesanan as $l){
    //         //$p->quantity = $l->quantity;
    //         $p->quantity = $listpesanan->quantity;
    //         //echo $listpesanan->quantity;
    //         // $p->harga = $product->harga;
    //         // $p->nama_bengkel = $product->nama_bengkel;
    //         // $p->quantity = $list_pesanan->quantity;
    //         // $p->nama_product = $product->nama_product;
    //         // $p->picUrl = $product->picUrl;
    //         }
    //     //$i->count += 1;
    //     }
    //     dd($listpesanan->quantity);

    //     return view('admin.list_pesanan', ['listpesanans' => $listpesanan/*, 'pesanans' => $pesanan*/]);
    // }

    public function listPesanan(){
        $bengkel = Bengkel::where('id_pemilik', Auth::id())->get() ->first();
        //dd($bengkel);
        $bengkelproduct = BengkelProduct::where('id_bengkel','=',$bengkel->id)->get();
        //dd($bengkelproduct);
        foreach($bengkelproduct as $bp){
        $listpesanan[] = UserKeranjang::where('id_product', '=', $bp->id)->get();
        }
        //dd($listpesanan[0]);

        foreach($listpesanan as $lp){
            //dd($lp[0]);
            foreach($lp as $lplp){
                //dd($lplp);
                $pesanan[] = $lplp;
            }
        }

        foreach($pesanan as $pesananorang){
            //dd($pesananorang);
            $user = User::where('id', '=', $pesananorang->id_user)->first();
            $barang = BengkelProduct::where('id', '=', $pesananorang['id_product'])->first();
            $pesananorang['name'] = $user->name;
            $pesananorang['nama_product'] = $barang->nama_product;
            $pesananorang['quantity'] = $pesananorang['quantity'];
            $pesananorang['harga'] = $barang->harga;
            $pesananorang['picUrl'] = $barang->picUrl;
        }

        //dd($pesanan);

        return view('admin.list_pesanan', ['listpesanans' => $pesanan]);
    }

    public function formSpecialties()
    {
        $bengkel = Bengkel::where('id_pemilik', Auth::id())->get() ->first();
        $brand = Brand::all();

        return view('admin.input_specialties', ['brands' => $brand/*, 'bengkels' => $bengkel*/]);
    }
}
