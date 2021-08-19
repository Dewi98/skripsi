<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample Email Massage</title>
    {{ Html::style('user_assets/css/bootstrap.min.css') }}
</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                {{ Html::image('user_assets/img/new-logo.png', 'Lobster', ['class' => 'img-responsive mx-auto']) }}
                <hr>
            </div>

            <div class="col-md-6">
                <small>
                <p>Hi, {{ $user }}</p>
                <p>
                    Jika menerima email ini berarti password telah berhasil di reset oleh system,
                    gunakan password di bawah untuk login kedalam website lobster lalu silahkan rubah password di bawah
                    dengan password baru.
                    <br><br>
                    #Terima Kasih - Admin.
                </p>
                <table>
                    <tr>
                        <td>Email Pengguna</td>
                        <td>:</td>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr>
                        <td>Password Baru</td>
                        <td>:</td>
                        <td>{{ $password }}</td>
                    </tr>
                </table>
                </small>
            </div>

        </div>

    </div>

    {{ Html::script('user_assets/js/jquery-3.2.1.min.js') }}
    {{ Html::script('user_assets/js/popper.min.js') }}
    {{ Html::script('user_assets/js/bootstrap.min.js') }}
</body>
</html>