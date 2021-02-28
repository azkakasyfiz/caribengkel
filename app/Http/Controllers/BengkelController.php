<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bengkel;
use App\BengkelSpecialties;
use App\BengkelProduct;
use App\BengkelDiscussion;
use App\BengkelDiscussionReply;

class BengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bengkel = Bengkel::where('id', $id)->first();
        $specialities = DB::table('bengkel_specialties')->where('id_bengkel','=', $bengkel->id)
            ->join('brands', 'brands.id', '=', 'bengkel_specialties.id_brand')
            ->select('brands.nama')
            ->get();
            foreach($specialities as $key => $value){
                $bengkel->{'specialties'. $key} = $value->nama;
            }

        $products = BengkelProduct::where('id_bengkel','=', $bengkel->id)
            ->join('sparepart_categories', 'bengkel_products.id_categories', '=', 'sparepart_categories.id')
            ->join('brands', 'brands.id','=','sparepart_categories.id_brand')
            ->select(DB::raw('brands.nama as nama_brand'), DB::raw('sparepart_categories.nama as nama_kategori'), 'bengkel_products.*')
            ->get();
                    
        $discussion = BengkelDiscussion::where('id_bengkel','=', $bengkel->id)
            ->join('users', 'users.id', '=' , 'bengkel_discussions.id_user')
            ->select('bengkel_discussions.*', 'users.name', 'users.id AS user_id')
            ->get();
        
        $reply = BengkelDiscussionReply::where('id_bengkel', '=', $bengkel->id)
            ->join('users', 'users.id', '=' , 'bengkel_discussion_replies.id_user')
            ->select('bengkel_discussion_replies.*', 'users.name', 'users.id AS user_id')
            ->get();

        return view('bengkel.detail', ['bengkel' => $bengkel, 'products' => $products, 'discussions' => $discussion, 'replies' => $reply]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
