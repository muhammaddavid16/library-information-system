<?php

namespace App\Http\Controllers;

use App\Contracts\SettingContract;
use App\Http\Requests\Setting\FineSettingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    public SettingContract $settingService;

    public function __construct(SettingContract $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(): Response
    {
        $fineSetting = $this->settingService->getFineSetting();

        return response()->view('setting', [
            'title' => 'Pengaturan',
            'fineSetting' => $fineSetting,
        ]);
    }

    public function update(FineSettingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->settingService->setFineSetting($validated);

        return redirect()->route('settings')->with('success', 'Pengaturan berhasil diperbarui');
    }
}
