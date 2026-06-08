<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\News;
use App\Models\PhotoGallery;
use App\Models\Review;
use App\Models\User;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            $notification = [
                'message' => 'Admin Login Successful',
                'alert-type' => 'success',
            ];

            return redirect()->route('admin-dashboard')->with($notification);
        }

        $notification = [
            'message' => 'Invalid Credentials',
            'alert-type' => 'error',
        ];

        return back()->with($notification)->onlyInput('email');
    }

    public function dashboard()
    {
        $stats = [
            'news' => News::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'pendingReviews' => Review::where('status', false)->count(),
            'contacts' => ContactUs::count(),
            'photos' => PhotoGallery::count(),
            'videos' => VideoGallery::count(),
            'admins' => Admin::count(),
        ];

        $latestNews = News::latest()->limit(5)->get();

        return view('admin.index', compact('stats', 'latestNews'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Admin Logout Successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin-login')->with($notification);
    }

    public function adminProfile()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile', compact('admin'));
    }

    public function adminProfileUpdate(Request $request)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id)],
            'phone' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $admin->fill($validated);

        if ($request->hasFile('image')) {
            if ($admin->image) {
                @unlink(public_path('storage/admin/'.$admin->image));
            }

            $image = $request->file('image');
            $filename = 'admin'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/admin'), $filename);
            $admin->image = $filename;
        }

        $admin->save();

        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = Hash::make($request->new_password);
            $admin->password_hint = null;
            $admin->save();

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $notification = [
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('admin-login')->with($notification);
        }

        $notification = [
            'message' => 'Old password is not match',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }

    public function allAdmin()
    {
        $alladminusers = Admin::latest()->get();

        return view('admin.admin.adminlist', compact('alladminusers'));
    }

    public function addAdmin()
    {
        return view('admin.admin.addadmin');
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'phone' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'password' => Hash::make($validated['password']),
            'password_hint' => null,
            'status' => true,
        ]);

        $notification = [
            'message' => 'New Admin User Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin-all-list')->with($notification);
    }

    public function editAdmin($id)
    {
        $data = Admin::findOrFail($id);

        return view('admin.admin.editadmin', compact('data'));
    }

    public function updateAdmin(Request $request)
    {
        $admin = Admin::findOrFail($request->id);

        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:admins,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id)],
            'phone' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->phone = $validated['phone'] ?? null;
        $admin->address = $validated['address'] ?? null;
        $admin->save();

        $notification = [
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin-all-list')->with($notification);
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        $notification = [
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        Admin::findOrFail($id)->update(['status' => 0]);

        $notification = [
            'message' => 'Admin Inactive Successfully',
            'alert-type' => 'error',
        ];

        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        Admin::findOrFail($id)->update(['status' => 1]);

        $notification = [
            'message' => 'Admin Active Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
