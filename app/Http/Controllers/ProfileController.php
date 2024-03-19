<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\Profile\AccountDeleteRequest;
use App\Http\Requests\Profile\PasswordChangeRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected UserContract $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {
        return response()->view('profile', [
            'title' => 'Profil Saya',
            'user' => Auth::user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->updateUser($user, $validated);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(PasswordChangeRequest $request, User $user): RedirectResponse
    {
        $validated = $request->safe()->only(['password']);

        $this->userService->updateUser($user, $validated);

        return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui.');
    }

    public function destroy(AccountDeleteRequest $request, User $user): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $this->userService->deleteUser($user);

        return redirect()->route('login')->with('success', 'Akun berhasil dihapus.');
    }
}
