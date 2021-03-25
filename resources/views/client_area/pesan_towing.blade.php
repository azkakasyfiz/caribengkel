@extends('layouts.wsearch2')
@section('title', 'Pesan Towing | caribengkel.id')
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
    <link type="text/css"  href="bootstrap-datepicker/css/bootstrap-datepicker.css"  rel="stylesheet">
    <link href="/regForm/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/regForm/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">PESAN TOWING</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/pesantowing/input" id="InputPesananTowing" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}" placeholder="Nama Pemesan">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="phone" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="No Handphone">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat Lengkap">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <label for="categories">Tanggal Pemesanan</label>
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="date" id="date" value="{{ old('date') }}" placeholder="Tanggal Pemesanan">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <label for="categories">Jam Pemesanan</label>
                                <div class="input-group">
                                    <input class="input--style-5" type="time" name="time" id="time" value="{{ old('time') }}:00" placeholder="Jam Pemesanan">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <select id="id_bengkel_tujuan" name="id_bengkel_tujuan" class="form-control">
                                    <option value="" disabled selected>Pilih Bengkel</option>
                                    @foreach($bengkels as $bengkel)
                                    <option value="{{$bengkel->id}}">{{$bengkel->nama_bengkel}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Pesan</button>
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

    <script src="jquery/jquery-2.2.1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <script>
    $('#tanggal').datepicker({
            format: 'yyyy-mm-dd',
            daysOfWeekDisabled: "0",
            autoclose:true
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

@endsection