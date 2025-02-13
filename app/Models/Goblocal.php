<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goblocal extends Model
{
    protected $table = 'goblocal';

    public function paciente(): BelongsTo {

        return $this->belongsTo(Paciente::class);
    }
}
