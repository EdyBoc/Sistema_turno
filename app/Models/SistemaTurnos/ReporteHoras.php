<?php

namespace App\Models\SistemaTurnos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReporteHoras extends Model
{
    use HasFactory;

    protected $table = 'reporte_horas'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id_reporte_horas'; // Clave primaria de la tabla
    protected $guarded = []; // Atributos que no se pueden asignar de forma masiva
    public $timestamps = false; // Indica si la tabla tiene timestamps (created_at, updated_at)
}
