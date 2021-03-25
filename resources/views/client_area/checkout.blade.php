@extends('layouts.wsearch2')
@section('title', 'Checkout | caribengkel.id')
@section('content')

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Name -->
						<h5 class="text-center">Nomor Antrian:</h5>
                        <h4 class="text-center">{{$nomorantrians}}</h4>
                        <p>Silakan tunjukan nomor antrian anda ke bengkel tujuan dengan benar</p>
						<!--<a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>-->
					</div>
					<div class="row">
                        <!-- Left sidebar -->
                        <div class="col-md-12">
                            <div class="sidebar">
                                <div class="widget price text-center">
                                    <h4>Total Biaya Pembelian</h4>
                                    <p>Rp. {{ number_format(($checkouts),0,',','.' )}}</p>
                                    <h6>Pembayaran dilakukan secara cash di toko terkait</h6>
                                    <!-- Submii button -->
                                    <!--<a href="" class="btn btn-transparent-white">Upload Bukti Pembayaran</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Checkout</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($keranjangs as $cart)
                            <tr>
                                <td class="product-thumb">
                                    <img width="60px" height="auto" src="/picUrl_product/{{$cart->picUrl}}" alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title">>{{$cart->nama_product}}</h3>
                                    <span class="location"><strong>Bengkel: {{$cart->nama_bengkel}}</strong></span>
                                </td>
                                <td class="product-details"><span class="categories">{{$cart->quantity}} X Rp. {{ number_format($cart->harga,0,',','.')}}</span></td>
                                <td class="product-category"><strong class="categories">Rp. {{ number_format(($cart->harga) * $cart->quantity),0,',','.' }}</strong></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Row End -->

    </div>
    <!-- Container End -->
</section>

@endsection