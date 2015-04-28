<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model {

    protected $table = 'ACTIVIDADES';
    protected $primarykey = 'ID';


    public function unidades()
    {
        return $this->belongsToMany('App\Unidad', 'UNIDADES_ACTIVIDADES','ACTIVIDAD_ID','UNIDAD_ID');
    }

}
