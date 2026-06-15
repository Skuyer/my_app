<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher; // Asegúrate de importar esto
use Cake\ORM\Entity;

class User extends Entity
{
    // ... Código existente (como $_accessible) ...

    // Método setter automático para la propiedad 'password'
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}