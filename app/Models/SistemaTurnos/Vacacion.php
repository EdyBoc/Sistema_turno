<?php

namespace App\Models\SistemaTurnos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vacacion extends Model
{
    use HasFactory;

    protected $table = 'vacacion';
    protected $primaryKey = 'id_vacacion';
    protected $guarded = [];
    public $timestamps = false;
}
