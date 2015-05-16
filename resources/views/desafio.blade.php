<!DOCTYPE html>
<html>

<head>
    @include('...layouts.meta')
</head>

<body>

    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg">

        @include('layouts.header')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Desafío</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/dashboard">Inicio</a>
                        </li>
                        <li class="active">
                            <strong>Desafío</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content  animated fadeInRight article">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox">
                        <div class="ibox-content">
                            <!--<div class="pull-right">
                                <button class="btn btn-white btn-xs" type="button">Model</button>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                                <button class="btn btn-white btn-xs" type="button">Modern</button>
                            </div>-->

                            <div class="text-center article-title">
                                <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>
                                <h1>
                                    {{ $actividad->NOMBRE }}
                                </h1>
                            </div>
                            <hr/>
                            @if(count($galeria))

                            <div class="m-b-md">
                                <a data-toggle="modal" href="#portada-form" title="Agregar Imagenes">Subir Más Imagenes</a>
                            </div>

                            <div class="carousel slide" id="carousel1">
                                <div class="carousel-inner">
                                    <?php $i = 0;?>
                                    @foreach($galeria as $imagen)
                                    <?php $i += 1;?>
                                    <div class="item @if($i == 1) active @endif">
                                        <img alt="image" class="img-responsive" src="{{ $imagen->RUTA_WEB }}" width="100%">
                                    </div>
                                    @endforeach
                                </div>
                                <a data-slide="prev" href="#carousel1" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel1" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a>
                            </div>


                            @else
                                <div class="col-lg-offset-2">
                                <a data-toggle="modal" href="#portada-form" title="Agregar Imagenes">
                                    <img alt="image" class="img-responsive" src="/img/no-image.png" width="500">
                                </a>
                                </div>
                            @endif

                            <hr/>

                            <p>
                                {{ $actividad->DESCRIPCION }}
                            </p>

                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                        <!--<h5>Tags:</h5>
                                        <button class="btn btn-primary btn-xs" type="button">Model</button>
                                        <button class="btn btn-white btn-xs" type="button">Publishing</button>-->
                                </div>
                                <div class="col-md-6">
                                    <div class="small text-right">
                                        <h5>Stats:</h5>
                                        <div> <i class="fa fa-comments-o"> </i> 56 comments </div>
                                        <i class="fa fa-eye"> </i> 144 views
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="portada-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                            <h4>Cargar Imagenes</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="ibox">
                                    <!--<div class="ibox-title">
                                        <h5>Modifcar Imagenes</h5>
                                    </div>-->
                                    <!--<div class="ibox-content">-->
                                        <form id="my-awesome-dropzone" class="dropzone" action="/formulario/cargarImg">

                                            <div class="fallback"><input name="file" type="file" multiple /></div>
                                            <div class="dropzone-previews"></div>

                                            <!--<input  type="hidden" name="dir" value="">-->
                                            <input type="hidden" name="_relacion" value="{{ $actividad->ID }}"/>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="finish">Terminar</button>
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
        </div>



    <!-- Mainly scripts -->
    <script src="/js/front/jquery-2.1.1.js"></script>
    <script src="/js/front/bootstrap.min.js"></script>
    <!--<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>-->
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/front/inspinia.js"></script>
    <!--<script src="/js/plugins/pace/pace.min.js"></script>-->

    <!-- DROPZONE -->
    <script src="/js/plugins/dropzone/dropzone.js"></script>
    <!--Document Ready-->
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $("#finish").on("click", function(){
                location.reload();
            });

            Dropzone.options.myAwesomeDropzone = {
                maxFilesize: 100, // MB
                autoProcessQueue: true,
                uploadMultiple: true,
                parallelUploads: 2,
                maxFiles: 3,
                acceptedFiles: ".png, .jpeg, .jpg, .gif",
                addRemoveLinks: false,
                init: function() {
                    this.on("error", function(file, message) { console.error("Error: " + message); });
                    //this.on("success", function(e, response) { alert(response); });
                },
                successmultiple: function(e,response){
                    console.log(response);
                    if(!response.error){
                        //$("#galeria").append(generateHtml(response.data.imgId, response.data.imgPath));
                    }
                }
            };


            function generateHtml(imgId, imgPath){
                var html = "<div id='" + imgId + "' class='item'>";
                html += "<img alt='image' class='' src='"+ imgPath +"' width='702' height='250'>";
                html += "<a class='deleteImg' data-owner='" + imgId + "' href='#'>Eliminar Imagen</a>";
                html += "</div>";
                return html;
            }
        });
    </script>

</body>

</html>
