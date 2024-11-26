<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

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

        // Get the currently authenticated user
        $currentUser = Auth::user();

        // Prevent the current admin from changing their own role to "user"
        if ( $currentUser->id === $user->id && $user->hasRole('admin')) {
            return redirect()->back()->withErrors(['error' => 'You cannot change your own role to user while managing users.']);
        }

        // Sync the roles and assign the new role
        $user->syncRoles([]); // Remove all current roles
        $user->assignRole($request->role); // Assign the new role

        return redirect()->back()->with('success', 'User role updated successfully');
    }

    public function toggleActivation(Request $request, User $user)
    {
        $request->validate([
            'activation_id' => 'required|exists:activations,id'
        ]);

        $activation = Activation::findOrFail($request->activation_id);

        // Get the currently authenticated user
        $currentUser = Auth::user();

        // Prevent the current admin from changing their own role to "user"
        if ( $currentUser->id === $user->id && $user->activations->contains($activation->id)) {
            return redirect()->back()->withErrors(['error' => 'Your cannot change your own activation status while managing users.']);
        }

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
