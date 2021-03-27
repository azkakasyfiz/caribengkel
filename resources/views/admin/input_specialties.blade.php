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
                    <h2 class="title">INPUT BRAND SPECIALTIES</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="/inputspecialties/add" id="InputSpecialties" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="value">
                                <select id="id_brand" name="id_brand" class="form-control">
                                    <option value="" disabled selected>Pilih Brand</option>
                                    @foreach ( $brands as $p )
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Input Brand Specialties</button>
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