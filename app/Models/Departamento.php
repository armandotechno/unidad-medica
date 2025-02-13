<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departamento extends Model
{
    public function departamentoPaciente(): BelongsTo {

        return $this->belongsTo(Paciente::class);
    }
}
