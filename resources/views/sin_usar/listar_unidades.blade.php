<!DOCTYPE html>
<html>

<head>

@include('layouts.meta')

</head>

<body>
    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">

            @include('layouts.header')

            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Desafíos</h5>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Unidad</th>
                                            <th>Actividad #1</th>
                                            <th>Actividad #2</th>
                                            <th>Actividad #3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($unidades as $unidad)
                                        <tr>
                                            <td><a href="/categorias/{{ $unidad->ID }}">{{ $unidad->NOMBRE }}</a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
