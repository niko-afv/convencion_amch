<?php namespace App\Http\Controllers;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $unidades = \App\Club::find(11)->unidades()->get();
        return view('dashboard', array(
            'unidades' => $unidades
        ));
	}

    public function categorias($unidad){
        $categorias = \App\Categoria::all();

        return view('categorias', array(
            'categorias' => $categorias,
            'unidad_id' => $unidad
        ));
    }

    public function ver_desafio($unidad, $desafio){
        print_r($unidad."-");
        print_r($desafio."-");
        $oDesafio = \App\Unidad::find($unidad)->actividade->get();
        print_r($oDesafio);die;
        /*return view('desafio', array(

        ));*/
    }

    public function formulario($unidad, $categoria){
        $oUnidad = \App\Unidad::find($unidad)->get();
        $oCateforia = \App\Categoria::find($categoria)->get();
        $actividades = \App\Actividad::where('CATEGORIA_ID',$categoria)->get();
        $dir = $oUnidad[0]->NOMBRE . "/" . $oCateforia[0]->NOMBRE;

        //\App\Unidad::find($unidad)->actividades()->attach(0,array('UNIDAD_ID' => $unidad));

        return view('formulario', array(
            'actividades' => $actividades,
            'dir'         => $dir,
            'unidad'      => $unidad,
            'categoria'   => $categoria
        ));
    }

    public function guardar(){
        $inputs = \Input::all();
        \App\Unidad::find(
            $inputs['unidad'])->actividades()->attach(
                $inputs['desafio'], array(
                    'UNIDAD_ID'=>$inputs['unidad'],
                    'LUGAR'     => $inputs['lugar'],
                    'DESCRIPCION' => $inputs['descripcion']
            )
        );



        return redirect('/ver_desafio/'.$inputs['unidad'].'/'.$inputs['desafio']);

    }


    public function cargarImg(){
        try{
            $upload_dir = public_path() ."/uploads/unidades/".Input::get('dir');
            if(!file_exists($upload_dir)){
                mkdir($upload_dir);
                chmod($upload_dir, 0777);
            }
            $file = Input::file('file');
            $file = $file[0];
            print_r($file);die;
            $uploadSuccess = $file->move($upload_dir,$this->convert_string($file->getClientOriginalName()));
            /*$oImagen = new Imagen();
            $oImagen->PATH = $uploadSuccess->getRealPath();
            $oImagen->URL = str_replace(public_path(), "",$uploadSuccess->getRealPath());
            $oImagen->PROPIEDAD = Input::get('id');
            $oImagen->save();
            $response['data'] = array(
                'imgPath' => $oImagen->URL,
                'imgId' => $oImagen->ID,
            );
            $response['error'] = FALSE;
            $response['critic'] = FALSE;
            $response['msg'] ="Imagen agregada con exito";*/
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['critic'] = TRUE;
            $response['msg'] = $ex->getMessage();
        }
        return Response::json($response, 200);
    }

}
