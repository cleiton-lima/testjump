<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidaPlaca implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validaPlaca($value)) {
            $fail($this->message());
        }


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
