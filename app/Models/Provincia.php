<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Provincia extends Model
{
    public function provinciaPaciente(): BelongsTo {

        return $this->belongsTo(Provincia::class);
    }
}
