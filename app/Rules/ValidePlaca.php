<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\ValidationRule;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidePlaca implements Rule
{
    public function passes($attribute, $value)
    {
        $pattern = '/^[A-Z]{3}\d{4}$/'; // Padrão para placa convencional

        if (strlen($value) === 7 && $value[3] === '-') {
            $pattern = '/^[A-Z]{3}\d[A-Z]\d{2}$/'; // Padrão para placa Mercosul
        }

        return preg_match($pattern, $value) === 1;
    }

    public function message()
    {
        return 'A placa do carro é inválida.';
    }
}
