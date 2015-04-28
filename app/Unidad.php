<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model {

    protected $table = 'UNIDADES';
    protected $primarykey = 'ID';

    public function club()
    {
        return $this->belongsTo('App\Club');
    }

    public function actividades()
    {
        return $this->belongsToMany('App\Actividad','UNIDADES_ACTIVIDADES','UNIDAD_ID','ACTIVIDAD_ID');
    }
}
