@extends('layouts.wsearch2')
@section('title', 'Bengkel Favorit | caribengkel.id')
@section('content')
    <section class="section bg-light" style="padding-top:40px">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs" style="width:100%">
                    <li class="nav-item">
                        <a class="nav-link " href="/wishlist" style="font-size:20px">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/bengkel-favorit" style="font-size:20px">Bengkel Favorit</a>
                    </li>
                </ul>
            </div>
            <div class="row mt-5">
            @foreach($bengkels as $bengkel)
			<div class="col-sm-4 col-lg-4 col-md-4">
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
							
                            <a href="/unfav/{{$bengkel->id}}" class="btn btn-danger" style="position:absolute;bottom:7px;height:35px;padding: 10px 7px; font-size: 10px">Hapus</a>
						</div>
					</div>
				</div>
			</a>
			</div>
			@endforeach
            </div>
        </div>
    </section>
@endsection