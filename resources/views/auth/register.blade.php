<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Registrasi caribengkel.id">
    <meta name="author" content="caribengkel.id">

    <!-- Title Page-->
    <title>Register | caribengkel.id</title>

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
                    <h2 class="title">Registrasi Akun</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-row">
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="name" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="noHP" placeholder="Phone">
                                            <label class="label--desc">contoh : 08123456789</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
                        </div>
                        <div >
                            <p style="margin-top:20px">Sudah punya akun? <a href="/login">Login</a></p>
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