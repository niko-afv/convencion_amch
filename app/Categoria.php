<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

    protected $table = 'ACTIVIDADES_CATEGORIAS';
    protected $primarykey = 'ID';

    public function actividades()
    {
        return $this->hasMany('App\Actividad','ACTIVIDAD_ID','ID');
    }

}
