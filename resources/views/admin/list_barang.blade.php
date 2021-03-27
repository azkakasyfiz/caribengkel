@extends('layouts.wsearch2')
@section('title', 'List Barang | caribengkel.id')
@section('content')

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">List Barang</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th class="text-center">Nama Brand</th>
                                <th class="text-center">Kendaraan</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <!-- <th class="text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($products as $p)
                            <tr>
                                <td class="product-thumb">
                                    <img width="100px" height="auto" src="/picUrl_product/{{$p->picUrl}}" alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title">>{{$p->nama_product}}</h3>
                                </td>
                                <td class="product-category"><span class="categories">{{$p->nama_brand}}</span></td>
                                <td class="product-category"><span class="categories">{{$p->kendaraan}}</span></td>
                                <td class="product-category"><span class="categories">{{$p->quantity}} pcs</span></td>
                                <td class="product-category"><span class="categories">Rp. {{ number_format($p->harga,0,',','.')}}</span></td>
                                <!--<td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a class="delete" href="/deleteproduct/{{$p->id}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                -->
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