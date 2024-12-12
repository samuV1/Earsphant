<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $table = 'atendimentos'; // Nome da tabela
    protected $fillable = [
        'setor',
        'usuario',
        'codigo',
        'servico',
        'subservico',
        'status',
        'fila',
        'descricao',
        'abertura',
        'fechamento',
        'ans',
        'encarregado',
        'prioridade',
        'equipamento',
        'programa',
    ]; // Campos permitidos para preenchimento


    public function setor()
    {
    return $this->belongsTo(Setor::class);
    }

    // gera o códgio da atendimento unico (chave primária)
    public static function gerarCodigoAtendimento()
    {
        // Pega o último código de atendimento criado
        $ultimoAtendimento = self::orderBy('id', 'desc')->first();

        // Se não houver atendimentos, inicia o código com "AT001"
        if (!$ultimoAtendimento) {
            return '001';
        }


        $ultimoCodigo = $ultimoAtendimento->codigo_atendimento;

        // Incrementa o número
        $novoNumero = str_pad($ultimoCodigo + 1, 3, '0', STR_PAD_LEFT);


        $ultimoCodigo = Atendimento::max('codigo');  // Pega o último código inserido
        $novoCodigo = str_pad($ultimoCodigo + 1, 3, '0', STR_PAD_LEFT);  // Incrementa e formata como string com 3 dígitos

        // Retorna o novo código
        return $novoCodigo;
    }
}
