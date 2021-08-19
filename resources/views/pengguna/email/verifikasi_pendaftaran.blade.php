<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{ Html::style('user_assets/css/bootstrap.min.css') }}
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Verifikasi Pendaftaran</h4>
                <hr>
                <p>
                    Hi, {{ $nama }} silahkan lakukan verifikasi pendaftaran anda dengan menggunakan url di bawah :
                </p>
                <p>
                    Silahkan klik link di bawah,<br>
                    {{ $link_verifikasi }}
                </p>
                <div class="mt-lg-5">
                    <small>
                        <address>
                            <b>Lobster</b>
                            <p class="text-muted">
                                Majalengka.<br>
                                Telephone : 085812345678
                            </p>
                        </address>
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{ Html::script('user_assets/js/jquery-3.3.1.min.js') }}
    {{ Html::script('user_assets/js/popper.min.js') }}
    {{ Html::script('user_assets/js/bootstrap.min.js') }}
</body>
</html>
