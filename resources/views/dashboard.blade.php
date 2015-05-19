<!DOCTYPE html>
<html>

<head>

@include('...layouts.meta')
<style>
    .categories{
        transition: all 0.3s ease;
    }
    .categories:hover{
        margin-top: 1px;
        -moz-box-shadow: 3px 3px 4px #444;
        -webkit-box-shadow: 3px 3px 4px #444;
        box-shadow: 3px 3px 4px #444;
        -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#444444')";
        filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#444444');
    }
</style>
</head>

<body>
    <div id="wrapper">

        @include('layouts.sidebar')

        <div id="page-wrapper" class="gray-bg">

            @include('layouts.header')

            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">



                        <div class="row wrapper border-bottom white-bg page-heading">
                            <div class="ibox-title">
                                <h5>Categorías</h5>
                            </div>
                            <div class="ibox-content">

                                @foreach($categorias as $categoria)
                                    <div class="col-lg-4">
                                        @if(count($desafio) >  0)
                                            <a href="/ver_desafio/{{ $desafio['id'] }}">
                                         @else
                                            <a href="/formulario/{{ $categoria->ID }}">
                                         @endif

                                        <div class="widget navy-bg no-padding categories">
                                            <div class="p-m">
                                                <h1 class="m-xs">{{ $fotos_count[$categoria->NOMBRE] }} Fotos</h1>

                                                <h3 class="font-bold no-margins">
                                                    Desafío: {{ $categoria->NOMBRE }}
                                                </h3>
                                                @if($fotos_count[$categoria->NOMBRE] > 0)
                                                    <small>Requisito cumplido: {{ $desafio['nombre'] }}</small>
                                                @else
                                                    <small>No Tienes ninguna imagen para este requisito.</small>
                                                @endif
                                            </div>
                                            <div class="flot-chart">
                                                <div class="flot-chart-content" id="flot-chart1" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 526px; height: 100px;" width="526" height="100"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 526px; height: 100px;" width="526" height="100"></canvas></div>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>

                            <div style="clear: both;"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
                Convecnión de Conquistadores <strong>2015</strong>.
            </div>
            <div>
                Developed by <a href="http://nicolasfredes.cl"><strong>Nks</strong></a> for Regional AMCH 2015.
            </div>
        </div>
    </div>

    @include('...layouts.footer')
</body>
</html>
