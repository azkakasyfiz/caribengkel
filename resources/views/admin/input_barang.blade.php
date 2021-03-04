@extends('layouts.wsearch2')
@section('Admin | caribengkel.id')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Registrasi caribengkel.id">
    <meta name="author" content="caribengkel.id">
    <!-- Icons font CSS-->
    <link href="/regForm/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="/regForm/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="/regForm/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/regForm/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/regForm/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">INPUT BARANG</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/admin/inputproduct" id="InputProduct" enctype="multipart/form-data">
                    @csrf

                        <div class="form-row">
                            <div class="value">
                                <!-- <label for="categories">Kategori Barang</label> -->
                                <select id="id_categories" name="id_categories" class="form-control">
                                    <option value="" disabled selected>Pilih Kategori Barang</option>
                                    @foreach ( $namas as $p )
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <!-- <label for="categories">Kategori Barang</label> -->
                                <select id="kendaraan" name="kendaraan" class="form-control">
                                    <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                                    <option value="mobil">Mobil</option>
                                    <option value="motor">Motor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="nama_product" id="nama_product" value="{{ old('nama_product') }}" placeholder="Nama Produk">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" placeholder="Jumlah Stok">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Harga Satuan (Rupiah)">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="kendaraan" value="{{ old('kendaraan') }}" placeholder="Nama Kendaraan">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                <h5>Upload Gambar</h5>
                                <input type="file" class="form-control-file d-inline" name="picUrl" value="{{ old('picUrl') }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Upload Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="/regForm/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="/regForm/vendor/select2/select2.min.js"></script>
    <script src="/regForm/vendor/datepicker/moment.min.js"></script>
    <script src="/regForm/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="/regForm/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

@endsection