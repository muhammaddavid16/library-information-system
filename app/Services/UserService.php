<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class UserService implements UserContract
{
    public function getUserById(string $id): User
    {
        return User::findOrFail($id);
    }

    public function getFilteredUsers(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $user = User::latest()
            ->filter($keyword)
            ->paginate($perPage)
            ->withQueryString();

        return $user;
    }

    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        if ($user->isAdministrator()) {
            throw ValidationException::withMessages([
                'error' => 'Tidak bisa menghapus admin.'
            ]);
        }

        return $user->delete();
    }
}
