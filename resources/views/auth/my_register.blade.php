<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Convención AMCH 2015 | Register</title>

    <link href="/css/back/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/back/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/back/animate.css" rel="stylesheet">
    <link href="/css/back/style.css" rel="stylesheet">

    <!--Chosen Plugin-->
    <link href="/css/back/plugins/chosen/chosen.css" rel="stylesheet">


    <style>
        h1{
        font-size: 110px !important;
        }
    </style>

</head>

<body class="gray-bg">

    <div class="middle-box loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">AMCH</h1>

            </div>
            <h3 class="text-center">Activación de Acceso Convención 2015</h3>
            <p class="text-center">Para que tu club aparezca en el listado, debe estar registrado en nuestro campo.</p>
            <form class="m-t" role="form" method="POST" action="{{ url('/auth/register') }}">
                <div class="form-group">
                    <select class="chosen-select form-control" data-validation="select_club" name="club">
                        <option value="">Seleccione su Club </option>
                        @foreach($clubes as $club)
                            <option value="{{ $club->ID }}"> {{ $club->NOMBRE }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Nombre de Usuario" data-validation="required">
                </div>
                <!--<div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" data-validation="email">
                </div>-->
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" data-validation="length" data-validation-length="min6">
                </div>

                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <button type="submit" class="btn btn-primary block full-width m-b">Activar</button>

                <p class="text-muted text-center"><small>Si tu club no aparece, puede deberse a que ya fue activado o a que no está registrado en nuestro campo</small></p>
                <a class="btn btn-sm btn-white btn-block" href="/">Ir al Inicio</a>
            </form>
            <p class="m-t text-center"> <small>Regional de Conquistadores AMCH &copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/front/jquery-2.1.1.js"></script>
    <script src="/js/front/bootstrap.min.js"></script>

    <!--JQuery Form Validation-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>

    <script src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="/js/register.js"></script>
</body>

</html>
