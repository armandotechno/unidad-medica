<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distrito extends Model
{
    public function paciente(): BelongsTo {

        return $this->belongsTo(Paciente::class);
    }
}
