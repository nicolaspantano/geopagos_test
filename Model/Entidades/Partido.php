<?php

namespace App\Models;

use App\Models\Jugador;
use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;

class Partido extends Model {

    protected $table = 'partidos';
    public $timestamps = false;
    protected $primaryKey = 'id';
    
    public function torneo() {
        return $this->belongsTo(Torneo::class);
    }

    public function jugar(Jugador $jugadorUno, Jugador $jugadorDos): Jugador {

        $nivelJugadorUno = rand(0, $jugadorUno->habilidad);

        switch($jugadorUno->genero)
        {
            case 'Masculino':
                $nivelJugadorUno += ($jugadorUno->velocidad_de_desplazamiento + $jugadorUno->fuerza);
                break;

            case 'Femenino':
                $nivelJugadorUno += $jugadorUno->velocidad_de_desplazamiento;
                break;
        }

        $nivelJugadorDos = rand(0, $jugadorDos->habilidad);

        $ganador = ($nivelJugadorUno > $nivelJugadorDos) ? $jugadorUno : $jugadorDos;

        $this->guardarResultados($ganador->id, ($ganador == $jugadorUno ? $jugadorDos->id : $jugadorUno->id));

        return $ganador;
    }

    private function guardarResultados($ganadorId, $perdedorId)
    {
        $this->ganador_id = $ganadorId;
        $this->perdedor_id = $perdedorId;

        $this->save();
    }
}