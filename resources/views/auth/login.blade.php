<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengadaan Barang - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
 <script src="js/html5shiv.js"></script>
 <script src="js/respond.min.js"></script>
 <![endif]-->
</head>

<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading text-center">LOGIN</div>
                <div class="panel-body">
                    <div class="text-center">
                        <h3>Pengadaan Barang</h3>
                    </div><br>
                    <form role="form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <fieldset>
                            <div class="form-group @error('email') has-error @enderror">
                                <input class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Alamat Email" name="email" type="email" autofocus="">
                                @error('email')
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group @error('password') has-error @enderror">
                                <input class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password" type="password" value="">
                                @error('password')
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <button class="btn btn-primary btn-block btn-lg">Login</button>
                        </fieldset><br><br>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->


    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
