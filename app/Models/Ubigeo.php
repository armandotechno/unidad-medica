<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ubigeo extends Model
{
    protected $table = 'ubigeo';

    public function paciente(): BelongsTo {

        return $this->belongsTo(Paciente::class);
    }
}
