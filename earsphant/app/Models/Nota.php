<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas'; // Nome da tabela
    protected $fillable = [
        'atendimento',
        'usuario',
        'descricao',
        'data',
    ]; // Campos permitidos para preenchimento
}
