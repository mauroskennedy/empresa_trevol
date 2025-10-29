<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';

    protected $fillable = ['nombre_cargo'];

    // 🔗 Un cargo tiene muchos empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'cargo_id');
    }
}
