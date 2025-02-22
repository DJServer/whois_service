<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $user = EloquentUser::where('email', $email)->first();
        if (!$user) {
            return null;
        }
        return new User(
            id: $user->id,
            email: $user->email,
            password: $user->password,
            createdAt: $user->created_at
        );
    }

    public function save(User $user): User
    {
        $model = EloquentUser::updateOrCreate(
            ['email' => $user->email],
            ['password' => $user->password]
        );

        return new User(
            id: $model->id,
            email: $model->email,
            password: $model->password,
            createdAt: $model->created_at
        );
    }
}
