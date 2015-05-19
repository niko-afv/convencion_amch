<?php namespace App\Http\Controllers;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class DesafioController extends Controller {

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

    public function ver_desafio($desafio){
        //$oDesafio = \App\Club::has('actividades')->get();
        $session_club = \Session::get('Club');
        $actividad = \DB::table('CLUBES')
            ->join('CLUBES_ACTIVIDADES', 'CLUBES.ID', '=', 'CLUBES_ACTIVIDADES.CLUB_ID')
            ->join('ACTIVIDADES', 'ACTIVIDADES.ID', '=', 'CLUBES_ACTIVIDADES.ACTIVIDAD_ID')

            ->select('ACTIVIDADES.NOMBRE','CLUBES_ACTIVIDADES.ID','CLUBES_ACTIVIDADES.DESCRIPCION')
            ->where('CLUBES_ACTIVIDADES.ACTIVIDAD_ID',$desafio)
            ->where('CLUBES_ACTIVIDADES.CLUB_ID',$session_club['id'])
            ->get();

        $galeria = \DB::table('IMAGENES')
            ->join('CLUBES_ACTIVIDADES', 'IMAGENES.RELACION_ID', '=', 'CLUBES_ACTIVIDADES.ID')
            ->where('CLUBES_ACTIVIDADES.ID',$actividad[0]->ID)
            ->get();

        return view('desafio', array(
            'actividad'   => $actividad[0],
            'galeria'      => $galeria

        ));
    }

    public function formulario($categoria){
        $oCategoria = \App\Categoria::find($categoria)->get();
        $actividades = \App\Actividad::where('CATEGORIA_ID',$categoria)->get();

        //\App\Unidad::find($unidad)->actividades()->attach(0,array('UNIDAD_ID' => $unidad));

        return view('formulario', array(
            'actividades' => $actividades,
            'categoria'   => $categoria
        ));
    }

    public function guardar(){
        $inputs = \Input::all();
        $club = \Session::get('Club');

        $actividades = \DB::table('CLUBES')
            ->join('CLUBES_ACTIVIDADES', 'CLUBES.ID', '=', 'CLUBES_ACTIVIDADES.CLUB_ID')
            ->join('ACTIVIDADES', 'ACTIVIDADES.ID', '=', 'CLUBES_ACTIVIDADES.ACTIVIDAD_ID')
            ->select('CLUBES_ACTIVIDADES.*')
            ->where('CLUBES_ACTIVIDADES.ACTIVIDAD_ID',$inputs['desafio'])
            ->where('CLUBES_ACTIVIDADES.CLUB_ID',11)
            ->get();

        if(count($actividades)){
            print_r($actividades[0]->ID);
        }else{
            \App\Club::find(
            $club['id'])->actividades()->attach(
                $inputs['desafio'], array(
                    'CLUB_ID'=>$club['id'],
                    'LUGAR'     => $inputs['lugar'],
                    'DESCRIPCION' => $inputs['descripcion']
                )
            );
        }
        return redirect('/ver_desafio/'.$inputs['desafio']);
    }


    public function cargarImg(){
        try{
            $session_club = \Session::get('Club');
            $upload_dir = public_path() ."/uploads/clubes/".$session_club['id'];
            if(!file_exists($upload_dir)){
                mkdir($upload_dir);
                chmod($upload_dir, 0777);
            }
            $final_upload_dir = public_path() ."/uploads/clubes/".$session_club['id']. "/" . \Input::get('_relacion');
            if(!file_exists($final_upload_dir)){
                mkdir($final_upload_dir);
                chmod($final_upload_dir, 0777);
            }

            $file = \Request::file('file');
            $file = $file[0];
            $uploadSuccess = $file->move($upload_dir,/*$this->convert_string(*/$file->getClientOriginalName()/*)*/);

            $oImagen = new \App\Imagen();
            $oImagen->RUTA_LOCAL = $uploadSuccess->getRealPath();
            $oImagen->RUTA_WEB = str_replace(public_path(), "",$uploadSuccess->getRealPath());
            $oImagen->RELACION_ID = \Input::get('_relacion');
            $oImagen->save();
            $response['data'] = array(
                'imgPath' => $oImagen->RUTA_WEB
            );
            $response['error'] = FALSE;
            $response['critic'] = FALSE;
            $response['msg'] ="Imagen agregada con exito";
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['critic'] = TRUE;
            $response['msg'] = $ex->getMessage();
        }
        return response()->json($response, 200);
    }

}
