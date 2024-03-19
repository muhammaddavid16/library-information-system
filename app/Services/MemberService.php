<?php

namespace App\Services;

use App\Contracts\MemberContract;
use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MemberService implements MemberContract
{
    public function getMemberById(string $id): Member
    {
        return Member::findOrFail($id);
    }

    public function getAllMembers(): Collection
    {
        return Member::all();
    }

    public function getSortedMembers(string $row): Collection
    {
        return Member::all()->sortBy($row);
    }

    public function getFilteredMembers(?string $keyword, int $perPage = 15): LengthAwarePaginator
    {
        $member = Member::latest()
            ->filter($keyword)
            ->paginate($perPage)
            ->withQueryString();

        return $member;
    }

    public function createMember(array $data): Member
    {
        return Member::create($data);
    }

    public function updateMember(Member $member, array $data): Member
    {
        $member->update($data);

        return $member;
    }

    public function deleteMember(Member $member): bool
    {
        return $member->delete();
    }
}
