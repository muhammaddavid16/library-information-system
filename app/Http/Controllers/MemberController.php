<?php

namespace App\Http\Controllers;

use App\Contracts\MemberContract;
use App\Http\Requests\Member\MemberAddRequest;
use App\Http\Requests\Member\MemberUpdateRequest;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    protected MemberContract $memberService;

    public function __construct(MemberContract $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index(): Response
    {
        return response()->view('members.index', [
            'title' => 'Anggota',
            'members' => $this->memberService->getFilteredMembers(request('cari')),
        ]);
    }

    public function create(): Response
    {
        return response()->view('members.create', [
            'title' => 'Tambah Anggota',
        ]);
    }

    public function store(MemberAddRequest $request): RedirectResponse
    {
        $this->memberService->createMember($request->validated());

        return redirect()->route('members')->with('success', 'Anggota berhasil ditambah.');
    }

    public function edit(Member $member): Response
    {
        return response()->view('members.edit', [
            'title' => 'Edit Anggota',
            'member' => $member,
        ]);
    }

    public function update(MemberUpdateRequest $request, Member $member): RedirectResponse
    {
        $this->memberService->updateMember($member, $request->validated());

        return redirect()->route('members')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $this->memberService->deleteMember($member);

        return back()->with('success', 'Anggota berhasil dihapus.');
    }
}
