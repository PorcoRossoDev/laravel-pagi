<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\PermissionModule;
use App\Models\PermissionAction;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class PermissionStructureController extends Controller
{
    public function index()
    {
        $modules = PermissionModule::all();
        $actions = PermissionAction::all();
        return response()->json($modules);
    }

    public function store(Request $request)
    {
        $rules = [
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:permission_modules,name',
        ];
        $messages = [
            'label.required' => 'Tên module không được để trống.',
            'name.required' => 'Mã module không được để trống.',
            'name.unique' => 'Mã module đã tồn tại.',
        ];
        $validated = $request->validate($rules, $messages);
        try {
            $module = PermissionModule::create($validated);
            return response()->json([
                'message' => 'Tạo module thành công.',
                'data' => $module
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Lỗi lưu module: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi lưu module.',
            ], 500);
        }
    }
}
