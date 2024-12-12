<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipamentoAtendimento extends Model
{
    use HasFactory;

    protected $table = 'equipamento_atendimentos'; // Nome da tabela
    protected $fillable = [
        'equipamento',
        'atendimento',
    ]; // Campos permitidos para preenchimento
}
