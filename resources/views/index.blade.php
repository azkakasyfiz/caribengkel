@extends('layouts.main')
@section('title', 'caribengkel.id | Portal Bengkel Otomotif se-Indonesia!')
@section('content')

<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly hero-search">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>PORTAL BENGKEL OTOMOTIF<br>SE-JAKARTA!</h1>
					<p>Temukan bengkel terbaik untuk mobil dan motor kamu hanya di caribengkel.id</p>
					<!-- search bar -->
					<form action="/search/bengkel">
						<div class="input-group md-form form-sm form-2 pl-0 pb-2" style="width:60%;margin:auto">
							<input class="form-control my-0 py-1 lime-border" style="background:white" name="cari" type="text" placeholder="Cari bengkel, sparepart.." aria-label="Search">
							<div class="input-group-append">
								<button type="submit" class="input-group-text lime lighten-2" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
							</div>
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	<div class="container">
	
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section" style="padding-top:30px">
		<div class="container mb-5">
			<div class="row justify-content-center mt-5">	
				<div class="col-lg-10 col-10">
					<div id="web_banner" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#web_banner" data-slide-to="0" class="active"></li>
							<li data-target="#web_banner" data-slide-to="1"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<a href="/design-interior"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/728x90" alt="Design Interior"></a>
							</div>
							<div class="carousel-item">
								<a href="/bangun-renovasi?v=2"><img class="d-block w-100 img-fluid" src="https://via.placeholder.com/728x90" alt="Bangun & Renovasi"></a>
							</div>
						</div>
						<a class="carousel-control-prev" href="#web_banner" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#web_banner" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	<div class="container">
		<div class="section-title">
			<h2>Cari Bengkel</h2>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<a href="/cari-bengkel/mobil">
				<div class="card category-otomotif zoom" style="background: linear-gradient(90deg, rgba(205,234,242,1) 40%, rgba(171,220,230,1) 60%);">
					<img class="card-img-top" src="/fontawesome/svgs/solid/car.svg" alt="Card image cap" style="width:250px;height:250px;margin:auto">
					<div class="card-body">
						<h5 class="card-title" style="text-align:center;color:white">Mobil</h5>
					</div>
				</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="/cari-bengkel/motor">
				<div class="card category-otomotif zoom" style="background: linear-gradient(90deg, rgba(205,234,242,1) 40%, rgba(171,220,230,1) 60%);">
					<img class="card-img-top" src="/fontawesome/svgs/solid/motorcycle.svg" alt="Card image cap" style="width:250px;height:250px;margin:auto">
					<div class="card-body">
						<h5 class="card-title" style="text-align:center;color:white">Motor</h5>
					</div>
				</div>
				</a>
			</div>
		</div>
	</div>
	<div class="container pt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Rekomendasi</h2>
				</div>
			</div>
		</div>
		<div class="row">
			@foreach($bengkels->shuffle()->take(6) as $bengkel)
			<div class="col-sm-12 col-lg-4 col-md-4">
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
							
							<p style="position:absolute;height:30px;bottom:2px"><i class="fa fa-heart fa-md" style="color:red;"></i>   {{$bengkel->fav}}</p>
						</div>
					</div>
				</div>
			</a>
			</div>
			@endforeach
		</div>
	</div>
</section>



<!--==========================================
=            Brands Section            =
===========================================-->

<section class="section bg-light">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>Sparepart</h2>
					<p>Temukan sparepart untuk berbagai macam brand!</p>
				</div>
				<div class="row">
					<!-- brand -->
					@foreach($brands as $brand)
					<div class="col-md-3">
						<a href="/search/sparepart?brand={{$brand->nama}}">
						<div class="card card-brand zoom">
							<img class="card-img-top brand-img" src="/brand-img/{{$brand->picUrl}}" alt="Card image cap">
							<h1 class="m-0 mb-1" style="text-align:center">{{$brand->nama}}</h1>
						</div>	
						</a>				
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

@endsection

  



