<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['users'] = User::all();

        if ($request->has('search')) {
            $search = $request->input('search');
            $data['users'] = $data['users']->filter(function ($user) use ($search) {
                return stripos($user->name, $search) !== false || stripos($user->email, $search) !== false;
            });
        }

        $data['search'] = $request->input('search');
        return view('users.index', $data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $notification = [
            'message' => 'User berhasil dibuat!',
            'alert-type' => 'success',
        ];

        return redirect()->route('users.index')->with($notification);
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

      

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        $notification = [
            'message' => 'User berhasil diupdate!',
            'alert-type' => 'success',
        ];

        return redirect()->route('users.index')->with($notification);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        $notification = [
            'message' => 'User berhasil dihapus!',
            'alert-type' => 'success',
        ];

        return redirect()->route('users.index')->with($notification);
    }
}
