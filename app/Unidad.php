<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model {

    protected $table = 'UNIDADES';
    protected $primarykey = 'ID';

    public function club()
    {
        return $this->belongsTo('App\Club','CLUB_ID');
    }
}
