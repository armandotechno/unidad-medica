<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    public function getConsultas(): HasMany {

        return $this->hasMany(Consulta::class, 'paciente_id', 'id');
    }

    public function getCitas(): HasMany {

        return $this->hasMany(Cita::class, 'dni', 'dni');
    }

    public function departamento(): HasOne {

        return $this->hasOne(Departamento::class, 'id', 'departamento_id');
    }

    public function provincia(): HasOne {

        return $this->hasOne(Provincia::class, 'id', 'provincia_id');
    }

    public function distrito(): HasOne {

        return $this->hasOne(Distrito::class, 'id', 'distrito_id');
    }

    public function gobLocal(): HasOne {

        return $this->hasOne(Goblocal::class, 'id', 'goblocal_id');
    }

    public function ubiGeo(): HasOne {

        return $this->hasOne(Ubigeo::class, 'id', 'ubigeo_id');
    }
}
