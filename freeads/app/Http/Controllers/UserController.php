<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    // --- Pour l'utilisateur connecté ---
    public function show()
    {
        if(auth()->check()){
            $user = auth()->user();
            $page = "Profile";
            $email = auth()->user()->email;

            return view('user.profile', compact('user', 'page','email'));
        } else {
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }

    public function update(Request $request)
    {
        if(auth()->check()){
            $user = auth()->user();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                // 'email' => 'required|email|unique:users,email,' . $user->id,
                'phone'=>'nullable',
            ]);
            $user->update($data);
            return redirect()->back()->with('success', 'Profile updated.');
        } else {
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }

    public function destroy()
    {
        if(auth()->check()){
            $user = auth()->user();
            $user->delete();
            return redirect('/')->with('success', 'Account Deleted.');
        } else {
            return redirect()->route('login')->with('error', 'Please log in.');
        }
    }

    public function changeForm() {
        $email = auth()->user()->email;
        return view('user.change-password', [
            'page'=> "Change Password",
            'email'=>$email,
        ]);
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }



     // --- Pour l'admin ---
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'=>'required|string',
        ]);
        $user->update($data);
        return redirect()->back()->with('success', 'User Updated.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Deleted User.');
    }
}
