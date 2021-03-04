@extends('layouts.wsearch2')
@section('title', 'Keranjang | caribengkel.id')
@section('content')

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Keranjang</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($keranjangs as $cart)
                            <tr>
                                <td class="product-thumb">
                                    <img width="100px" height="auto" src="/picUrl_product/{{$cart->picUrl}}" alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title">>{{$cart->nama_product}}</h3>
                                    <span class="location"><strong>Bengkel:</strong><a href="/bengkel/{{$cart->id_bengkel}}">{{$cart->nama_bengkel}}</a></span>
                                </td>
                                <td class="product-category"><span class="categories">{{$cart->quantity}} pcs</span></td>
                                <td class="product-category"><span class="categories">Rp. {{ number_format($cart->harga,0,',','.')}}</span></td>
                                <td class="product-category"><span class="categories">Rp. {{ number_format(($cart->harga) * $cart->quantity),0,',','.' }}</span></td>
                                <td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <!--<li class="list-inline-item">
                                                <a data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="view" href="/bengkel/{{$cart->id_bengkel}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </li>-->
                                            <li class="list-inline-item">
                                                <a class="edit" href="/cart/{{$cart->id_product}}/minus">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="edit" href="/cart/{{$cart->id_product}}/plus">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="delete" href="/uncart/{{$cart->id_product}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Sub Total</h4>
						<p>Rp. {{ number_format(($cart->harga) * $cart->quantity),0,',','.' }}</p>
                        <!-- Submii button -->
						<a href="" class="btn btn-transparent-white">Checkout</a>
					</div>
				</div>
			</div>

		</div>
    </div>
    <!-- Container End -->
</section>

@endsection