@extends('layouts.wsearch2')
@section('title', 'Wishlist | caribengkel.id')
@section('content')
    <section class="section bg-light" style="padding-top:40px">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs" style="width:100%">
                    <li class="nav-item">
                        <a class="nav-link active" href="/wishlist" style="font-size:20px">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bengkel-favorit" style="font-size:20px">Bengkel Favorit</a>
                    </li>
                </ul>
            </div>
            <div class="row mt-5">
                @foreach($wishlists as $wish)
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top bengkel-img" src="/produk-img/{{$wish->picUrl}}" alt="Card image cap">
                        <div class="card-body" style="position:relative;height:110px">
                            <h5 class="card-title" style="font-size:13px">{{$wish->nama_product}}</h5>
                            <p class="card-title" style="font-size:13px">{{$wish->nama_bengkel}}</p>
                            <div style="position:absolute;bottom: 3px;height:25px;">
                                <a href="/unwish/{{$wish->id_product}}" class="" style="font-size:10px"><i class="fa fa-trash fa-2x" style="color:grey"></i></a>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" style="border-top:solid rgba(0,0,0,.125) 1px">Harga : Rp. {{ number_format($wish->harga,0,',','.')}}</li>
                            <li class="list-group-item">Stock : x{{$wish->quantity}}</li>
                            <a href="/bengkel/{{$wish->id_bengkel}}"><li class="list-group-item" style="text-align:center;background:#cdeaf2">Kunjungi Bengkel</li></a>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection