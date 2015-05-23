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

            @include('...layouts.header')

            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">



                        <div class="row wrapper border-bottom white-bg page-heading">
                            <div class="ibox-title">
                                <h5>Categorías</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">

                                <?php //print_r($actividades);die;?>
                                    <table class="table-hover table-bordered  table">
                                        <thead>
                                            <th>#</th>
                                            <th>Club</th>
                                            <th>Buen Samaritano</th>
                                            <th>Buen Ciudadano</th>
                                            <th>Buen Sembrador</th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0;?>
                                            @foreach($clubes_actividades as $club)
                                                <?php $i+=1; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $club['nombre'] }}</td>
                                                    @if(count($club['actividades']))
                                                        @if( isset($club['actividades']['Buen Samaritano']) )
                                                                <td style="text-align: center">
                                                                    <a href="/ver_desafio/{{ $club['actividades']['Buen Samaritano']['id'] }}/{{ $club['id'] }}"><i class="fa fa-check text-navy"></i></a>
                                                                </td>
                                                        @else
                                                            <td style="text-align: center">
                                                                <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                            </td>
                                                        @endif
                                                        @if( isset($club['actividades']['Buen Ciudadano']) )
                                                                <td style="text-align: center">
                                                                    <a href="/ver_desafio/{{ $club['actividades']['Buen Ciudadano']['id'] }}/{{ $club['id'] }}"><i class="fa fa-check text-navy"></i></a>
                                                                </td>
                                                        @else
                                                            <td style="text-align: center">
                                                                <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                            </td>
                                                        @endif
                                                        @if( isset($club['actividades']['Buen Sembrador']) )
                                                            <td style="text-align: center">
                                                                <a href="/ver_desafio/{{ $club['actividades']['Buen Sembrador']['id'] }}/{{ $club['id'] }}"><i class="fa fa-check text-navy"></i></a>
                                                            </td>
                                                        @else
                                                            <td style="text-align: center">
                                                                <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                            </td>
                                                        @endif
                                                    @else
                                                    <td style="text-align: center">
                                                        <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="#"><i class="fa fa-remove text-danger"></i></a>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
