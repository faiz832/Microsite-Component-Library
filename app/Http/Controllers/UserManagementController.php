<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::with(['roles', 'activations'])->get();
        $roles = Role::all();
        $activations = Activation::all();
        
        return view('admin.users.index', compact('users', 'roles', 'activations'));
    }

    // Update role user
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        // Hapus semua role yang ada
        $user->syncRoles([]);
        
        // Assign role baru
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'User role updated successfully');
    }

    public function toggleActivation(Request $request, User $user)
    {
        $request->validate([
            'activation_id' => 'required|exists:activations,id'
        ]);

        $activation = Activation::findOrFail($request->activation_id);

        if ($user->activations->contains($activation->id)) {
            $user->deactivate($activation);
            $message = 'User has been deactivated';
        } else {
            $user->activate($activation);
            $message = 'User has been activated';
        }

        return redirect()->back()->with('success', $message);
    }
}
