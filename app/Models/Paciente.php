<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    public function getConsultas(): HasMany {

        return $this->hasMany(Consulta::class, 'paciente_id', 'id');
    }
}
