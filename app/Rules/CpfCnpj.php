<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfCnpj implements ValidationRule
{
    /**
     * Executa a validação do campo.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Limpa a máscara: remove tudo o que não for número (pontos, traços, barras)
        $c = preg_replace('/\D/', '', $value);

        if (strlen($c) === 11) {
            if (!$this->validaCPF($c)) {
                $fail('O CPF informado não é válido.');
            }
        } elseif (strlen($c) === 14) {
            if (!$this->validaCNPJ($c)) {
                $fail('O CNPJ informado não é válido.');
            }
        } else {
            $fail('O campo deve conter 11 dígitos (CPF) ou 14 dígitos (CNPJ).');
        }
    }

    /**
     * Algoritmo Matemático de Validação de CPF
     */
    private function validaCPF($cpf)
    {
        // Bloqueia CPFs com todos os números iguais (ex: 111.111.111-11)
        if (preg_match('/(\d)\1{10}/', $cpf)) return false;
        
        // Cálculo dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }

    /**
     * Algoritmo Matemático de Validação de CNPJ
     */
    private function validaCNPJ($cnpj)
    {
        // Bloqueia CNPJs com todos os números iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) return false;

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        
        // Cálculo do primeiro dígito verificador
        for ($i = 0, $n = 0; $i < 12; $n += $cnpj[$i] * $b[++$i]);
        if ($cnpj[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) return false;

        // Cálculo do segundo dígito verificador
        for ($i = 0, $n = 0; $i <= 12; $n += $cnpj[$i] * $b[$i++]);
        if ($cnpj[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) return false;

        return true;
    }
}