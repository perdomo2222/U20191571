<?php

namespace App\Reglas;

class SoloLetras extends LibroReglas
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z\s]+$/', $value);
    }

    public function message()
    {
        return 'El campo :attribute debe contener solo letras.';
    }
}

?>