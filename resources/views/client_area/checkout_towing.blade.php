@extends('layouts.wsearch2')
@section('title', 'Checkout Towing | caribengkel.id')
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
						<h5 class="text-center">Silakan transfer ke rekening</h5>
                        <h4 class="text-center">BNI 1234567890</h4>
                        <p>Batas waktu transfer 12 jam setelah pemesanan</p>
						<!--<a href="user-profile.html" class="btn btn-main-sm">Edit Profile</a>-->
					</div>
					<div class="row">
                        <!-- Left sidebar -->
                        <div class="col-md-12">
                            <div class="sidebar">
                                <div class="widget price text-center">
                                    <h4>Total Biaya Towing</h4>
                                    <p>Rp. {{ number_format((500000+$towings->id),0,',','.' )}}</p>
                                    <h6>Silakan transfer hingga angka terakhir dengan tepat dan benar.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Checkout Towing</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Pemesan</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$towings->nama_pemesan}}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center">No HP</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$towings->no_hp}}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center">Alamat</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$towings->alamat}}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$towings->date}}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center">Jam</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$towings->time}}</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th class="text-center">Bengkel Tujuan</th>
                                <th class="text-center"></th>
                                <th class="text-center">{{$bengkels->nama_bengkel}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="product-category"><strong class="categories"></strong></td>
                                <td class="product-category"><strong class="categories"></strong></td>
                                <td class="product-category"><strong class="categories"></strong></td>
                            </tr>

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