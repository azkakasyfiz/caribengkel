@extends('layouts.wsearch2')
@section('title', $bengkel->nama_bengkel.' | caribengkel.id')
@section('content')

<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray" style="padding-top:20px">
	<!-- Container Start -->
	<div class="container pb-5">
		<div class="product-details">
			<h1 class="product-title">{{$bengkel->nama_bengkel}}</h1>
			<div class="product-meta">
				<ul class="list-inline">
					<li class="list-inline-item"><i class="fa fa-location-arrow"></i> <a href="">{{$bengkel->daerah}}, {{$bengkel->kota}}</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="carouselExampleIndicators" class="product-slider carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
					</ol>
					<div class="carousel-inner" style="background: #8c8c8c; box-shadow:1px 1px 10px #808080;">
						<div class="carousel-item active">
							<img class="d-block carousel-bengkel-img" src="/bengkel-img/{{$bengkel->subPic}}/1.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<img class="d-block carousel-bengkel-img" src="/bengkel-img/{{$bengkel->subPic}}/2.jpg" alt="Second slide">
						</div>
						<div class="carousel-item">
							<img class="d-block carousel-bengkel-img" src="/bengkel-img/{{$bengkel->subPic}}/3.jpg" alt="Third slide">
						</div>
						<div class="carousel-item">
							<img class="d-block carousel-bengkel-img" src="/bengkel-img/{{$bengkel->subPic}}/4.jpg" alt="Third slide">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-details">
					<div class="content">
						<ul class="nav nav-pills " id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Overview</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-sparepart-tab" data-toggle="pill" href="#pills-sparepart" role="tab" aria-controls="pills-sparepart" aria-selected="false">Sparepart</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-discuss-tab" data-toggle="pill" href="#pills-discuss" role="tab" aria-controls="pills-discuss" aria-selected="false">Diskusi</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<div class="content" style="padding:0">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Detail</h3>
								<p class="mb-2" style="font-size:17px">Melayani Service :</p>
								<div class="row mb-3">
									<div class="col-md-3">
										<span style="font-size: 23px"><i class="fas fa-car"></i> Mobil</span>
									</div>
									<div class="col-md-3">
										<span style="font-size: 23px"><i class="fas fa-motorcycle"></i> Motor</span>
									</div>
								</div>
								<p style="font-size:17px">Support :</p>
								<p class="mb-5" style="font-size: 23px; color:black">
									@for($i = 0;$i < 15 && $bengkel->{'specialties'.$i} != NULL; $i++)
										{{ $bengkel->{'specialties'.$i} }}, 
									@endfor
								</p>

								<h3 class="tab-title">Lokasi</h3>
								<p class="mb-3" style="font-size:17px">Alamat :</p>
								<p style="font-size: 20px; color:black" class="mb-2">{{$bengkel->alamat}}</p>
								<p class="mb-5" style="font-size: 20px; color:black">{{$bengkel->daerah}}, {{$bengkel->kota}}</p>

								<h3 class="tab-title">Produk</h3>
								<div class="row">
								<?php $count = 0; ?>
								@foreach($products->take(3) as $product)
									<div class="col-md-12">
										<div class="card mb-4">
											<div class="row no-gutters">
												<div class="col-md-4">
													<img src="/produk-img/{{$product->picUrl}}" class="img-fluid mx-auto d-block" style="width:auto;height:200px;object-fit:cover" alt="">
												</div>
												<div class="col-md-8" style="border-left: 1px solid #aaaaaa">
													<div class="card-block pl-3 pt-3">
														<h4 class="card-title">{{$product->nama_product}}</h4>
														<h5 class="card-text" style="font-size:17px">Rp. {{ number_format($product->harga,0,',','.')}}</h5>
														<div class="row mb-2">
															<div class="col-md-4 col-6">
																<p class="card-text mb-0" style="color:black">Kategori : </p>
																<p class="card-text">{{$product->nama_kategori}}</p>
																<p class="card-text mb-0" style="color:black">Stock : </p>
																<p class="card-text">x{{$product->quantity}}</p>
															</div>
															<div class="col-md-4 col-6">
																<p class="card-text mb-0" style="color:black">Brand : </p>
																<p class="card-text ">{{$product->nama_brand}}</p>
															</div>
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								</div>
								<div class=row>
									<a class="nav-link" id="pills-sparepart-tab" data-toggle="pill" href="#pills-sparepart" role="tab" aria-controls="pills-sparepart" aria-selected="false">Lihat Semua</a>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-sparepart" role="tabpanel" aria-labelledby="pills-sparepart-tab">
								<h3 class="tab-title">Produk Sparepart</h3>
								<div class="row">
								@foreach($products as $product)
									<div class="col-md-12">
										<div class="card mb-4">
											<div class="row no-gutters">
												<div class="col-md-4">
													<img src="/produk-img/{{$product->picUrl}}" class="img-fluid" style="width:auto;height:200px;object-fit:cover" alt="">
												</div>
												<div class="col-md-8" style="border-left: 1px solid #aaaaaa">
													<div class="card-block pl-3 pt-3">
														<h4 class="card-title d-inline">{{$product->nama_product}}</h4>
														<h5 class="card-text" style="font-size:17px">Rp. {{ number_format($product->harga,0,',','.')}}</h5>
														<div class="row mb-2">
															<div class="col-md-4 col-6">
																<p class="card-text mb-0" style="color:black">Kategori : </p>
																<p class="card-text">{{$product->nama_kategori}}</p>
																<p class="card-text mb-0" style="color:black">Stock : </p>
																<p class="card-text">x{{$product->quantity}}</p>
															</div>
															<div class="col-md-4 col-6">
																<p class="card-text mb-0" style="color:black">Brand : </p>
																<p class="card-text ">{{$product->nama_brand}}</p>
															</div>
														</div>
															<a href="/wish/{{$product->id}}" style=color:red><i class="fa fa-heart" style="text-align:right"></i></a>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								</div>
							</div>
							
							<div class="tab-pane fade" id="pills-discuss" role="tabpanel" aria-labelledby="pills-discuss-tab">
								<h3 class="tab-title">Diskusi</h3>
								<div class="product-review">
									@foreach($discussions as $discuss)
							  		<div class="media">
							  			<!-- Avater -->
							  			<img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png" alt="avater">
							  			<div class="media-body">
							  				<div class="name">
							  					<h5>{{$discuss->name}} <span class="badge badge-secondary {{$discuss->user_id == $bengkel->id_pemilik ? '' : 'hidden'}}">bengkel</span></h5>
							  				</div>
							  				<div class="date">
							  					<p>{{date('d F Y', strtotime($discuss->created_at))}}</p>
							  				</div>
							  				<div class="review-comment">
							  					<p>
							  						{{$discuss->message}}	
												</p>
							  				</div>
											<hr>
											  <!-- replies -->
											  @foreach($replies as $reply)
											  @if($reply->id_discussion == $discuss->id)
											<div class="media">
												<!-- Avater -->
												<img src="https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png" alt="avater">
												<div class="media-body" style="background:#cdeaf2">
													<div class="name">
														<h5>{{$reply->name}} <span class="badge badge-secondary {{$reply->user_id == $bengkel->id_pemilik ? '' : 'hidden'}}">bengkel</span></h5>
													</div>
													<div class="date">
														<p>{{date('d F Y', strtotime($reply->created_at))}}</p>
													</div>
													<div class="review-comment">
														<p>
															{{$reply->message}}
														</p>
													</div>
												</div>
											</div>
											<!-- reply -->
												@endif
												@endforeach
											<form action="/discuss/reply" method="post">
											@csrf
											  <input type="text" class="form-control" placeholder="Tulis komentar kamu ..." name="message"><br>
											  <input type="hidden" value="{{$bengkel->id}}" name="id_bengkel">
											  <input type="hidden" value="{{$discuss->id}}" name="id_discussion">
											  <button class="btn btn-main">Reply</button>
											</form>
							  			</div>
							  		</div>
									 @endforeach
							  		<div class="review-submission">
							  			<h3 class="tab-title">Apa yang ingin kamu tanyakan?</h3>
						  				<!-- new diskusi -->
						  				<div class="review-submit">
						  					<form action="/discuss" method="post" class="row">
											  @csrf
						  						<div class="col-12">
						  							<textarea name="message" id="review" rows="5" class="form-control" placeholder="Message"></textarea>
						  						</div>
												  <!-- hidden -->
												  <input type="hidden" value="{{$bengkel->id}}" name="id_bengkel">
						  						<div class="col-12">
						  							<button type="submit" class="btn btn-main">Submit</button>
						  						</div>
						  					</form>
						  				</div>
							  		</div>
							  	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<!-- User Profile widget -->
					<div class="widget user">
						<h4>{{$bengkel->nama_bengkel}}</h4>
						<p class="member-time">Sejak {{date('d F Y', strtotime($bengkel->created_at))}}</p>
						<p>Contact :</p>
						<p><i class="fa fa-phone"></i>  {{$bengkel->telp}}</p>
						<a class="btn btn-main" style="padding: 10px 10px" href="/fav/{{$bengkel->id}}"><i class="fa fa-plus"></i>  Tambah ke Favorit</a>
					</div>
					<!-- Map Widget -->
					<div class="widget map">
						<div class="map">
							<div id="map"></div>
						</div>
					</div>	
				</div>
			</div>
			
		</div>
	</div>
	<!-- Container End -->
</section>
@endsection