<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\User\UserAddRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserContract $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {
        return response()->view('users.index', [
            'title' => 'Pengguna',
            'users' => $this->userService->getFilteredUsers(request('cari')),
        ]);
    }

    public function create(): Response
    {
        return response()->view('users.create', [
            'title' => 'Tambah Pengguna',
        ]);
    }

    public function store(UserAddRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->createUser($validated);

        return redirect()->route('users')->with('success', 'Pengguna berhasil ditambah.');
    }

    public function edit(User $user): Response
    {
        return response()->view('users.edit', [
            'title' => 'Edit Pengguna',
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->updateUser($user, $validated);

        return redirect()->route('users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->deleteUser($user);

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
