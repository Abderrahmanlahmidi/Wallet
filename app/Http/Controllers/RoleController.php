<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
        ]);

        $role = Role::create([
            'nom' => $request->nom,
            'description' => $request->description
        ]);

        if ($role) {
            return response()->json([
                'message' => 'Role created successfully'
            ], 202);
        } else {
            return response()->json([
                'message' => 'Role creation failed'
            ], 500);
        }
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return response()->json([
            'message' => 'Role deleted successfully'
        ], 201);

    }
}
