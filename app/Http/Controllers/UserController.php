<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function login()
    {
        return view('user.login');
    }

    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($validated);

        Auth::guard('web')->login($user);

        return redirect()->route('user-dashboard')->with([
            'message' => 'Registration successful',
            'alert-type' => 'success',
        ]);
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('user-dashboard'))->with([
                'message' => 'Login successful',
                'alert-type' => 'success',
            ]);
        }

        return back()->with([
            'message' => 'Invalid credentials',
            'alert-type' => 'error',
        ])->onlyInput('email');
    }

    public function userDashboard()
    {
        $data = Auth::guard('web')->user();

        return view('user.dashboard', compact('data'));
    }

    public function userProfileUpdate(Request $request)
    {
        /** @var User $user */
        $user = Auth::guard('web')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;

        if ($request->hasFile('image')) {
            if ($user->image) {
                @unlink(public_path('storage/user/'.$user->image));
            }

            $image = $request->file('image');
            $filename = 'user'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/user'), $filename);
            $user->image = $filename;
        }

        $user->save();

        return back()->with([
            'message' => 'Profile updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function userChangePassword()
    {
        return view('user.change_password');
    }

    public function userChangePasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        /** @var User $user */
        $user = Auth::guard('web')->user();

        if (! Hash::check($validated['old_password'], $user->password)) {
            return back()->with([
                'message' => 'Old password is not match',
                'alert-type' => 'error',
            ]);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user-login')->with([
            'message' => 'Password updated successfully. Please login again.',
            'alert-type' => 'success',
        ]);
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user-login')->with([
            'message' => 'Logout successful',
            'alert-type' => 'success',
        ]);
    }
}
