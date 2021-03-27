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
                    <h2 class="title">INPUT BENGKEL</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/registbengkel" id="RegistBengkel" enctype="multipart/form-data">
                    @csrf

                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="nama_bengkel" id="nama_bengkel" value="{{ old('nama_bengkel') }}" placeholder="Nama Bengkel">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="telp" id="telp" value="{{ old('telp') }}" placeholder="No Handphone">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="daerah" id="daerah" value="Jakarta" placeholder="Daerah" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <select id="kota" name="kota" class="form-control">
                                    <option value="" disabled selected>Pilih Kota</option>
                                    <option value="Jakarta Pusat">Jakarta Pusat</option>
                                    <option value="Jakarta Selatan">Jakarta Selatan</option>
                                    <option value="Jakarta Barat">Jakarta Barat</option>
                                    <option value="Jakarta Utara">Jakarta Utara</option>
                                    <option value="Jakarta Timur">Jakarta Timur</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" placeholder="Alamat">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Masukkan link embed dari google maps">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <select id="motor" name="motor" class="form-control">
                                    <option value="" disabled selected>Melayani Motor?</option>
                                    <option value="1">Ya, Melayani Motor</option>
                                    <option value="0">Tidak Melayani Motor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <select id="mobil" name="mobil" class="form-control">
                                    <option value="" disabled selected>Melayani Mobil?</option>
                                    <option value="1">Ya, Melayani Mobil</option>
                                    <option value="0">Tidak Melayani Mobil</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <label for="categories">Jam Buka</label>
                                <div class="input-group">
                                    <input class="input--style-5" type="time" name="open_hour" id="open_hour" value="{{ old('open_hour') }}:00" placeholder="Jam Buka">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <label for="categories">Jam Tutup</label>
                                <div class="input-group">
                                    <input class="input--style-5" type="time" name="close_hour" id="close_hour" value="{{ old('close_hour') }}:00" placeholder="Jam Tutup">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                <h5>Upload Foto Bengkel</h5>
                                <input type="file" class="form-control-file d-inline" name="picUrl" value="{{ old('picUrl') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                <h5>Upload Sub Foto Bengkel</h5>
                                <input type="file" class="form-control-file d-inline" name="subPic" value="{{ old('subPic') }}">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Input Bengkel</button>
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