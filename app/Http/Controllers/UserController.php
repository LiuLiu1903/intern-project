<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(UpdateProfileRequest $request, User $user)
    {
        // Kiểm tra quyền chỉnh sửa (bổ sung vào middleware hoặc trong authorize() của FormRequest)
        if (Auth::id() !== $user->id) {
            return response()->json(['error' => 'Bạn không có quyền chỉnh sửa hồ sơ này!'], 403);
        }

        // Cập nhật dữ liệu đã được validated từ FormRequest
        $user->update($request->validated());

        return response()->json([
            'message' => 'User updated successfully!',
            'user' => $user
        ]);
    }
}
