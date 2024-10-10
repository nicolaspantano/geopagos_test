<?php
namespace App\Models;

require_once 'Model/Entidades/Jugador.php';
require_once 'Model/Entidades/Partido.php';

use Illuminate\Database\Eloquent\Model;
use App\Models\Partido as Partido;

class Torneo extends Model
{

    protected $table = 'torneos';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function partidos() {
        return $this->hasMany(Partido::class);
    }

    public function jugar(array $jugadores, int $torneoId): Jugador {
        while (count($jugadores) > 1) {
            $jugadores = $this->jugarRonda($jugadores, $torneoId);
        }

        return array_pop($jugadores);
    }

    public function jugarRonda(array $jugadores, int $torneoId): array {
        $ganadores = [];
        for ($i = 0; $i < count($jugadores); $i += 2) {
            
            $partido = new Partido();
            $partido->torneo_id = $torneoId;
            $partido->save();


            $jugadorUno = array_pop($jugadores);
            $jugadorDos = array_pop($jugadores);

            $ganadores[] = $partido->jugar($jugadorUno, $jugadorDos);
        }
        
        return $ganadores;
    }

    public function establecerGanador($ganadorId)
    {
        $this->ganador_id = $ganadorId;
        $this->save();
    }
}
