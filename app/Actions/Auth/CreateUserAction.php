<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;

final readonly class CreateUserAction
{
    public function handle(array $data): User
    {
        return User::query()->create($data);
    }
}
