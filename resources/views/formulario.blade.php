<!DOCTYPE html>
<html>

<head>

@include('layouts.meta')
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
                            <div class="col-lg-10">
                                <h2>Desafío: {{ $categoria->NOMBRE }}</h2>
                                <ol class="breadcrumb">
                                    <li><a href="/dashboard">Inicio</a></li>
                                    <li class="active"><strong >Formulario de Desafíos</strong></li>
                                </ol>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-offset-2">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><small>Para cumplir con el requisito debes completar este formulario</small></h5>
                                    <div class="ibox-tools">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li>
                                                <a data-toggle="modal" href="#portada-form" title="Agregar Imagenes">
                                                    <i class="fa fa-plus"></i>
                                                    &nbsp;&nbsp; Agregar mas Imagenes
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <form role="form" action="/formulario/guardar" method="POST">
                                            <div class="col-sm-6 b-r">
                                                <div class="form-group">
                                                    <label>Actividad: </label>
                                                    <select name="desafio" class="form-control">
                                                        <option value="">Selecciones la actividad realizada</option>
                                                        @foreach($actividades as $actividad)
                                                            <option value="{{ $actividad->ID }}">{{ $actividad->NOMBRE }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 b-r">
                                                <div class="form-group">
                                                    <label>Lugar</label>
                                                    <input name="lugar" class="form-control" type="text" placeholder="Ej: Plaza san benito"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Descripción </label>
                                                    <p>Comentanos brevemente de que se trató la actividad.</p>
                                                    <textarea class="form-control" name="descripcion"></textarea>
                                                </div>
                                                <div>
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs col-sm-12" type="submit">
                                                        <strong>Guardar</strong>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--<div class="col-sm-6"><h4>Imagenes de La Actividad</h4>
                                            <img src="http://clasionce-static.elonce.com/images/publicar-anuncio-gratis.png"    />
                                        </div>-->
                                    </div>
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
        </div>

    @include('layouts.footer')



    <!-- DROPZONE -->
    <script src="/js/plugins/dropzone/dropzone.js"></script>
    <!--Document Ready-->
    <script type="text/javascript">
        $(document).ready(function(){
            Dropzone.options.myAwesomeDropzone = {
                maxFilesize: 100, // MB
                autoProcessQueue: true,
                uploadMultiple: true,
                parallelUploads: 1,
                maxFiles: 3,
                acceptedFiles: ".jpeg, .png, .jpg, .gif",
                addRemoveLinks: true,
                init: function() {
                    this.on("error", function(file, message) { alert("Error: " + message); });
                },
                success: function(e,response){
                    if(!response.error){
                        $("#galeria").append(generateHtml(response.data.imgId, response.data.imgPath));
                    }
                }
            };
        });
    </script>


</body>
</html>
