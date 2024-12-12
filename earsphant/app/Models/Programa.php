<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas'; // Nome da tabela
    protected $fillable = [
        'codigo',
        'licenca',
        'nome',
        'fornecedor',
        'versao',
        'aquisicao',
        'terceiros',
    ]; // Campos permitidos para preenchimento
}
