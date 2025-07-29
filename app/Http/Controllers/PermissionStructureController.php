<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionModule;
use App\Models\PermissionAction;

class PermissionStructureController extends Controller
{
    public function index()
    {
        $modules = PermissionModule::all();
        $actions = PermissionAction::all();

        return response()->json([
            'modules' => $modules,
            'actions' => $actions,
        ]);
    }
}
