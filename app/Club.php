<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model {

    protected $table = 'CLUBES';
    protected $primarykey = 'ID';

    public function user()
    {
        return $this->hasOne('App\User');
    }

}
