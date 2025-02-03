<?php

namespace Database\Seeders;

use App\Models\Atencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Atencion::truncate();
        Atencion::insert([
            ['nombre' => 'ACIDO URICO'],
            ['nombre' => 'APLICACION DE VENOCLISIS'],
            ['nombre' => 'BILIRRUBINAS TOTALES Y FRACCIONADAS'],
            ['nombre' => 'CARNET SALUD AGLUTINACIONES-HEPATITIS B-BK EN ESPUTO'],
            ['nombre' => 'CERT. SALUD'],
            ['nombre' => 'CERTIFICADO BUENA SALUD'],
            ['nombre' => 'CERTIFICADO DE MATRIMONIO'],
            ['nombre' => 'CERTIFICADO DE SALUD'],
            ['nombre' => 'CERTIFICADO MEDICO - MATRIMONIO PERSONAL'],
            ['nombre' => 'CERTIFICADO PARA MATRIMONIO'],
            ['nombre' => 'COLESTEROL TOTAL'],
            ['nombre' => 'CONSULTA  OBSTETRICA'],
            ['nombre' => 'CONSULTA MEDICA'],
            ['nombre' => 'CONSULTA ODONTOLOGICA'],
            ['nombre' => 'CREATININA'],
            ['nombre' => 'CURACION CON RESINA X2'],
            ['nombre' => 'CURACION DE RESINA X3'],
            ['nombre' => 'CURACION RESINA'],
            ['nombre' => 'CURACION SIMPLE TOPICO'],
            ['nombre' => 'CURACION TOPICO'],
            ['nombre' => 'CURACIONES LOCALIZADAS'],
            ['nombre' => 'DETENCION DE CANCER UTERINO (PAPANICOLAOU)'],
            ['nombre' => 'EVALUACION MEDICA PARA OLIMPIADAS ESCOLARES'],
            ['nombre' => 'EVALUACION PARA MATRIMONIO'],
            ['nombre' => 'EXCERESIS DE UÑA'],
            ['nombre' => 'EXTRACCION DE DIENTES'],
            ['nombre' => 'EXTRACCION DE PUNTOS'],
            ['nombre' => 'EXTRACCION DE VARIOS PUNTOS'],
            ['nombre' => 'FOSFATA ALCALINA'],
            ['nombre' => 'GLUCOSA'],
            ['nombre' => 'GO TRANSAMINASAS'],
            ['nombre' => 'GP TRANSAMINASAS'],
            ['nombre' => 'HDL COLESTEROL'],
            ['nombre' => 'HEMOGLOBINA'],
            ['nombre' => 'HEMOGLOBINA NIÑOS EDUCACIONES INICIAL EXONERADOS.'],
            ['nombre' => 'HEMOGRAMA'],
            ['nombre' => 'HEMOGRAMA COMPLETO'],
            ['nombre' => 'HIV (PRUEBA RAPIDA) SIFILIS'],
            ['nombre' => 'INGRESO EXCEPCIONAL POR LICENCIA DE CONDUCIR'],
            ['nombre' => 'INYECTABLE ENDOVENOSO'],
            ['nombre' => 'INYECTABLE INTRAMUSCULAR'],
            ['nombre' => 'INYECTABLE SUBCUTANEA'],
            ['nombre' => 'LAVADO DE OIDO'],
            ['nombre' => 'LAVADO DE OIDOS POR DOS'],
            ['nombre' => 'LIMPIEZA DENTAL PROFILAXIS'],
            ['nombre' => 'LLENADO DE CERTIFICADO'],
            ['nombre' => 'ORINA COMPLETA'],
            ['nombre' => 'PAQUETE DENGUE  CON.M, HEM.C,'],
            ['nombre' => 'PARASITOLOGICO SERIADO'],
            ['nombre' => 'PARASITOLOGICO SIMPLE'],
            ['nombre' => 'PARASITOLOGICO X 2 MUESTRAS'],
            ['nombre' => 'PERFIL DE COAGULACION: TIEMPO DE COAGULACION, TIEMPO DE SANGRIA'],
            ['nombre' => 'PERFIL HEPATICO'],
            ['nombre' => 'PERFIL LIPIDICO '],
            ['nombre' => 'PESO Y TALLA'],
            ['nombre' => 'PQTE COMPLETO DEL PERFIL PRENATAL'],
            ['nombre' => 'PREGNOSTICON EN SANGRE (BHCG)'],
            ['nombre' => 'PRUEBA DENGUE'],
            ['nombre' => 'REACCION INFLAMATORIA'],
            ['nombre' => 'RECUENTO DE PLAQUETAS'],
            ['nombre' => 'RETIRO DE DISPOSITIVO INTRAUTERINO (DIU)'],
            ['nombre' => 'RPR - VDRL'],
            ['nombre' => 'SATURACION MAYOR DE 5 PUNTOS'],
            ['nombre' => 'SATURACION MENOR DE 5 PUNTOS'],
            ['nombre' => 'SENATI'],
            ['nombre' => 'SUTURA MAYOR DE 5 PUNTOS'],
            ['nombre' => 'SUTURA TOPICO'],
            ['nombre' => 'SUTURACION'],
            ['nombre' => 'TEST DE GRAHAM (HECES)'],
            ['nombre' => 'TIEMPO DE PROTOMBINA'],
            ['nombre' => 'TOMA DE PRESION ARTERIAL'],
            ['nombre' => 'TOPICO'],
            ['nombre' => 'TRIGLICERIDOS'],
            ['nombre' => 'UREA'],
            ['nombre' => 'UROCULTIVO, EXAMEN COMPLETO Y ANTIBIOGRAMA'],
            ['nombre' => 'VIH'],
        ]);
    }
}
