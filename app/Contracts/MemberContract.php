<?php

namespace App\Contracts;

use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface MemberContract
{
    public function getMemberById(string $id): Member;
    public function getAllMembers(): Collection;
    public function getSortedMembers(string $row): Collection;
    public function getFilteredMembers(?string $keyword, int $perPage = 15): LengthAwarePaginator;
    public function createMember(array $data): Member;
    public function updateMember(Member $member, array $data): Member;
    public function deleteMember(Member $member): bool;
}
