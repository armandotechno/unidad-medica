<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Atencion extends Model
{
    protected $table = 'atencion';

        public function especialidad(): HasOne {

        return $this->hasOne(Consulta::class, 'especialidad_id', 'id');
    }

}
