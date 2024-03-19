<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserContract
{
    public function getUserById(string $id): User;
    public function getFilteredUsers(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createUser(array $data): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): bool;
}
