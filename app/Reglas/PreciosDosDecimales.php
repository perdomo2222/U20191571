<?php

namespace App\Reglas;

class PreciosDosDecimales extends LibroReglas
{
    public function passes($attribute, $value)
    {
        return preg_match('/^\d+(\. \d{2})?$/',$value);
    }

    public function message()
    {
        return 'El campo :attribute debe tener dos decimales.';
    }
}
?>