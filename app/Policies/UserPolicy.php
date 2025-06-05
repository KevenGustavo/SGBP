<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin;
    }

    public function update(User $user, User $model): bool
    {
        return $user->id == $model->id;
    }

    public function delete(User $user): bool
    {
        return $user->isAdmin;
    }
}
