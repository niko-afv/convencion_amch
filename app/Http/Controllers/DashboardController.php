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

    public function index(){
        if(\Session::get('username') == 'Regional_AMCH'){
            return redirect('/dashboard/regionales');
        }

        $session_club = \Session::get('Club');

        $categorias = \App\Categoria::all();
        $desafio = array();
        foreach($categorias as $categoria){
            $count = \DB::table('ACTIVIDADES')
                ->join('CLUBES_ACTIVIDADES', 'ACTIVIDADES.ID', '=', 'CLUBES_ACTIVIDADES.ACTIVIDAD_ID')
                ->join('ACTIVIDADES_CATEGORIAS', 'ACTIVIDADES.CATEGORIA_ID', '=', 'ACTIVIDADES_CATEGORIAS.ID')
                ->join('IMAGENES', 'CLUBES_ACTIVIDADES.ID', '=', 'IMAGENES.RELACION_ID')
                ->select('*')
                ->where('ACTIVIDADES_CATEGORIAS.ID',$categoria->ID)
                ->where('CLUBES_ACTIVIDADES.CLUB_ID',$session_club['id'])
                ->count();
            $fotos_count[$categoria->NOMBRE] = $count;

            $actividades = \DB::table('ACTIVIDADES')
                ->join('CLUBES_ACTIVIDADES', 'ACTIVIDADES.ID', '=', 'CLUBES_ACTIVIDADES.ACTIVIDAD_ID')
                ->join('ACTIVIDADES_CATEGORIAS', 'ACTIVIDADES.CATEGORIA_ID', '=', 'ACTIVIDADES_CATEGORIAS.ID')
                //->join('IMAGENES', 'CLUBES_ACTIVIDADES.ID', '=', 'IMAGENES.RELACION_ID')
                ->select('ACTIVIDADES.NOMBRE','ACTIVIDADES.ID')
                ->where('ACTIVIDADES_CATEGORIAS.ID',$categoria->ID)
                ->where('CLUBES_ACTIVIDADES.CLUB_ID',$session_club['id'])
                ->get();

            foreach ($actividades as $actividad) {
                $desafio[$categoria->ID] = array(
                    'nombre'    => $actividad->NOMBRE,
                    'id'        => $actividad->ID
                );
            }
        }

        return view('dashboard', array(
            'fotos_count' => $fotos_count,
            'categorias' => $categorias,
            'desafio'    => $desafio
        ));
    }


    public function regionales(){
        $clubes = \App\Club::all();
        $categorias = \App\Categoria::all();

        $clubes_actividades = array();


        foreach($clubes as $club) {
            $xclub = array();
            $xclub['id'] = $club->ID;
            $xclub['nombre'] = $club->NOMBRE;
            $xclub['actividades'] = array();

            foreach ($categorias as $categoria) {
                $actividades = \DB::table('ACTIVIDADES')
                    ->join('CLUBES_ACTIVIDADES', 'ACTIVIDADES.ID', '=', 'CLUBES_ACTIVIDADES.ACTIVIDAD_ID')
                    ->join('ACTIVIDADES_CATEGORIAS', 'ACTIVIDADES.CATEGORIA_ID', '=', 'ACTIVIDADES_CATEGORIAS.ID')
                    //->join('IMAGENES', 'CLUBES_ACTIVIDADES.ID', '=', 'IMAGENES.RELACION_ID')
                    ->select('ACTIVIDADES.NOMBRE', 'ACTIVIDADES.ID')
                    ->where('ACTIVIDADES_CATEGORIAS.ID', $categoria->ID)
                    ->where('CLUBES_ACTIVIDADES.CLUB_ID', $club->ID)
                    ->get();


                foreach ($actividades as $actividad) {
                    $xactividad = array();
                    $xactividad['id'] = $actividad->ID;
                    $xactividad['nombre'] = $actividad->NOMBRE;

                    $xclub['actividades'][$categoria->NOMBRE] = $xactividad;
                }
            }
            $clubes_actividades[] = $xclub;
        }
        //print_r($clubes_actividades[10]);die;


        return view('dashboard_regional', array(
            'clubes'        => $clubes,
            'clubes_actividades'    => $clubes_actividades,
            //'categorias'    => $categorias,
            'actividades'   => $actividades
        ));
    }

}
