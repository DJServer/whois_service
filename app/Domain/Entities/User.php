<?php
namespace App\Domain\Entities;

use Illuminate\Support\Facades\Hash;

class User
{
    public function __construct(
        public int $id,
        public string $email,
        public string $password,
        public \DateTime $createdAt
    ) {}

    public function verifyPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
