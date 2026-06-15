<?php
namespace App\PasswordHasher;

use Authentication\PasswordHasher\AbstractPasswordHasher;

class PlainPasswordHasher extends AbstractPasswordHasher
{
    // Compara la contraseña del formulario directamente con la de la base de datos
    public function check(string $password, string $hashedPassword): bool
    {
        return $password === $hashedPassword;
    }

    // Devuelve la contraseña tal cual para que se guarde en texto plano
    public function hash(string $password): string
    {
        return $password;
    }
}