<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model {

    protected $table = 'CLUBES';
    protected $primarykey = 'ID';

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function zona()
    {
        return $this->belongsTo('App\Zona', 'ZONA','ID');
    }

    public function unidades()
    {
        return $this->hasMany('App\Unidad','CLUB_ID','ID');
    }

    public function actividades()
    {
        return $this->belongsToMany('App\Actividad','CLUBES_ACTIVIDADES','CLUB_ID','ACTIVIDAD_ID');
    }

}
