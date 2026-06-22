<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        log_activity('view_users', 'Listado de usuarios');

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $viewer = Auth::user();

        log_activity(
            'view_user',
            "Usuario {$viewer->email} ha visto a {$user->email}",
            $viewer->id
        );

        $user->load([
            'activities' => fn ($q) => $q->latest()->take(5)
        ]);

        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        log_activity('created_user', "Usuario creado: {$user->email}");

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        log_activity(
            'updated_user',
            'Usuario actualizado: ' . $user->email
        );

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        log_activity('deleted_user', "Eliminado: {$user->email}");

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}