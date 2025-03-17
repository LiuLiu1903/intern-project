<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        // Lấy user từ database để xác thực đúng đối tượng của model
        $user = User::find(Auth::id());

        if ($user instanceof User) {
            // Cập nhật thông tin
            $user->update($request->validated());

            return redirect()->route('profile.edit')->with('success', 'Cập nhật hồ sơ thành công');
        }

        return redirect()->route('profile.edit')->with('error', 'Không tìm thấy người dùng');
    }
}
