<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv',
        'memorandum',
        'cedula_identidad',
        'certificado_medico',
        'boleta_pago',
        'user_id',
        'cargo_id',
    ];

    // 🔗 Un empleado pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔗 Un empleado pertenece a un cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
