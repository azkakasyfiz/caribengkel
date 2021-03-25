@extends('layouts.wsearch2')
@section('title', 'Dasboard Towing | caribengkel.id')
@section('content')

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">List Pesanan Towing</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Pemesan</th>
                                <th class="text-center">User</th>
                                <th class="text-center">No. HP</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Bengkel Tujuan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan_towings as $pesanan_towing)
                            <tr>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->nama_pemesan}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->id_pemesan}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->no_hp}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->alamat}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->time}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->date}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->id_bengkel_tujuan}}</span></td>
                                <td class="product-category"><span class="categories">{{$pesanan_towing->status}}</span></td>
                                <td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a class="edit" href="/admintowing/pay/{{$pesanan_towing->id}}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </li>
                                            </li>
                                        </ul>
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a class="edit" href="/admintowing/acc/{{$pesanan_towing->id}}">
                                                    <i class="fa fa-automobile"></i>
                                                </a>
                                            </li>
                                            </li>
                                        </ul>
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a class="delete" href="/admintowing/dec/{{$pesanan_towing->id}}">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </li>
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
    </div>
    <!-- Container End -->
</section>

@endsection