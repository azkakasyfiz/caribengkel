@extends('layouts.wsearch2')
@section('title', 'List Pesanan | caribengkel.id')
@section('content')

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">List Pesanan</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Pelanggan</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($listpesanans as $p)
                            <tr>
                                <td class="product-thumb">
                                    <img width="100px" height="auto" src="/picUrl_product/{{$p->picUrl}}" alt="image description">
                                </td>
                                <td class="product-details">
                                    <h3 class="title">>{{$p['nama_product']}}</h3>
                                </td>
                                <td class="product-category"><span class="categories">{{$p['quantity']}} pcs</span></td>
                                <td class="product-category"><span class="categories">Rp. {{ number_format($p['harga'],0,',','.')}}</span></td>
                                <td class="product-category"><span class="categories">Rp. {{ number_format(($p['harga']) * $p['quantity']),0,',','.' }}</span></td>
                                <td class="product-category"><span class="categories">{{$p['name']}}</span></td>
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