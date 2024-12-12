<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;
    protected $table = 'equipamentos'; // Nome da tabela
    protected $fillable = [
        'setor',
        'tipo',
        'marca',
        'modelo',
        'patrimonio',
        'aquisicao',
        'alugado',
        'fornecedor',
    ]; // Campos permitidos para preenchimento
}
