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

        <div id="page-wrapper" class="gray-bg">

            @include('...layouts.header')

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
                                    <a href="/formulario/{{ $categoria->ID }}">
                                    <div class="widget navy-bg no-padding categories">
                                        <div class="p-m">
                                            <h1 class="m-xs">0</h1>

                                            <h3 class="font-bold no-margins">
                                                Desafío: {{ $categoria->NOMBRE }}
                                            </h3>
                                            <small>No Tienes ninguna imagen para este requisito.</small>
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
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>
    </div>

    @include('...layouts.footer')
</body>
</html>
