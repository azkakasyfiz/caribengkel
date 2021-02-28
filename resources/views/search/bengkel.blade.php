@extends('layouts.wsearch')
@section('title', 'Search | caribengkel.id')
@section('content')

<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Hasil untuk "{{request()->input('cari')}}"</h2>
					<p>{{count($bengkels)}} Hasil
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="category-sidebar">
					<div class="widget category-list">
                        <h4 class="widget-header">Kendaraan</h4>
                        <ul class="category-list">
                            <li><a href="{{request()->fullUrlWithQuery(['kendaraan' => 'mobil'])}}">Mobil</a></li>
                            <li><a href="{{request()->fullUrlWithQuery(['kendaraan' => 'motor'])}}">Motor</a></li>
                        </ul>
                    </div>

                    <div class="widget category-list">
                        <h4 class="widget-header">Lokasi</h4>
                        <ul class="category-list">
                            <li><a href="/search/bengkel/jakarta-pusat?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Jakarta Pusat </a></li>
                            <li><a href="/search/bengkel/jakarta-barat?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Jakarta Barat </a></li>
                            <li><a href="/search/bengkel/jakarta-utara?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Jakarta Utara </a></li>
                            <li><a href="/search/bengkel/jakarta-selatan?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Jakarta Selatan </a></li>
                            <li><a href="/search/bengkel/jakarta-timur?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Jakarta Timur </a></li>
                        </ul>
                    </div>

                    <div class="widget category-list">
                        <h4 class="widget-header">Supported Brand</h4>
                        <ul class="category-list">
                        @foreach($supp as $brand)
                            <li><a href="{{request()->fullUrlWithQuery(['brand' => $brand->nama])}}">{{$brand->nama}} </a></li>
                        @endforeach
                        </ul>
                    </div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6">
							<h4><strong>Sort</strong></h4>
							<select class="custom-select">
								<option>Terbaru</option>
								<option value="2">Harga Terendah</option>
								<option value="4">Harga Tertinggi</option>
							</select>
						</div>
                    </div>
                </div>
				<div class="category-search-filter" style="background:white">
					<div class="row">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active">Bengkel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/search/sparepart?{{parse_url(url()->full(), PHP_URL_QUERY)}}">Sparepart</a>
                            </li>
                        </ul>
                    </div>
                </div>
				<div class="product-grid-list">
					<div class="row mt-30">
                        @if(count($bengkels) == 0)
                        <p class="mt-3 mb-5" style="text-align:center;margin:auto">Bengkel tidak ditemukan</p>
                        @endif
                        @foreach($bengkels as $bengkel)
						<div class="col-sm-12 col-lg-4 col-md-6">
                        <a href="/bengkel/{{$bengkel->id}}">
							<!-- product card -->
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <img class="card-img-top img-fluid product-img-small" src="/bengkel-img/{{$bengkel->picUrl}}.jpg" alt="Card image cap">
                                    </div>
                                    <div class="card-body" style="height:280px;position:relative">
                                        <h4 class="card-title">{{$bengkel->nama_bengkel}}</h4>
                                        <p class="card-text mb-2"><i class="fas fa-map-marker-alt mr-1"></i>{{$bengkel->daerah}}, {{$bengkel->kota}}</p>
                                        <ul class="list-inline product-meta">
                                            <p class="mb-0">Melayani :</p>
                                            @if($bengkel->mobil == 1)
                                            <li class="list-inline-item">
                                                <i class="fas fa-car"></i>Mobil
                                            </li>
                                            @endif
                                            @if($bengkel->motor == 1)
                                            <li class="list-inline-item">
                                                <i class="fas fa-motorcycle"></i>Motor
                                            </li>
                                            @endif
                                        </ul>
                                        <ul class="list-inline product-meta">
                                            <p class="mb-0">Support :</p>
                                            <p class="mb-0">
                                                @for($i = 0;$i < 3 && $bengkel->{'specialties'.$i} != NULL; $i++)
                                                    {{ $bengkel->{'specialties'.$i} }}, 
                                                @endfor
                                                @isset($bengkel->specialties3)
                                                    and more
                                                @endisset
                                            </p>
                                        </ul>
                                        
                                        <p style="position:absolute;height:15px;bottom:0px"><i class="fa fa-heart fa-md" style="color:red;"></i>   {{$bengkel->fav}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        @endforeach
                    </div>
                </div>
				<div class="pagination justify-content-left">
					<nav aria-label="Page navigation example">
						{!!$bengkels->links()!!}
					</nav>
				</div>
                <h4 class="mt-5">Sparepart Terkait</h4>
                <div class="product-grid-list">
					<div class="row mt-30">
                        @foreach($products->take(6) as $product)
						<div class="col-sm-12 col-lg-4 col-md-6">
                        <a href="/bengkel/{{$product->id_bengkel}}">
							<!-- product card -->
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <img class="card-img-top img-fluid product-img-small" src="/produk-img/{{$product->picUrl}}" alt="Card image cap">
                                    </div>
                                    <div class="card-body" style="height:300px; position:relative">
                                        <h4 class="card-title" style="font-size:16px">{{$product->nama_product}}</h4>
                                        <h5 class="card-text" style="font-size:14px">Rp. {{ number_format($product->harga,0,',','.')}}</h5>
                                        <h5 class="card-text" style="font-size:11px">By <strong>{{$product->nama_bengkel}}</strong></h5>
                                        <div class="row mb-2" >
                                            <div class="col-md-6 col-6">
                                                <p class="card-text mb-0" style="color:black">Kategori : </p>
                                                <p class="card-text">{{$product->nama_kategori}}</p>
                                                <p class="card-text mb-0" style="color:black">Stock : </p>
                                                <p class="card-text">x{{$product->quantity}}</p>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <p class="card-text mb-0" style="color:black">Brand : </p>
                                                <p class="card-text ">{{$product->nama_brand}}</p>
                                            </div>
                                        </div>
                                        
                                        <div style="position:absolute;bottom: 10px;height:25px;">
                                            <a href="/wish/{{$product->id}}" class="" style="font-size:10px"><i class="fa fa-heart fa-md" style="color:red"></i>   Tambah ke wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
@endsection