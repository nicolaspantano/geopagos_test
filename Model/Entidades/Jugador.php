<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model {

    protected $table = 'jugadores';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];
}
