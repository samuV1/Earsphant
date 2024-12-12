<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaAtendimento extends Model
{
    use HasFactory;

    protected $table = 'programa_atendimentos'; // Nome da tabela
    protected $fillable = [
        'programa',
        'atendimento',

    ]; // Campos permitidos para preenchimento
}
