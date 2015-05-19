<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model {

    protected $table = 'ZONAS';
    protected $primarykey = 'ID';

    public function clubes()
    {
        return $this->hasMany('App\Club','ZONA','ID');
    }

}
