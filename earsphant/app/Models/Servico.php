<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servicos'; // Nome da tabela
    protected $fillable = [
        'servico',
        'status',
        'ans',
    ]; // Campos permitidos para preenchimento
}
