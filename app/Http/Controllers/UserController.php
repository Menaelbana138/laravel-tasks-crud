<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role; // مهم 👈

class UserController extends Controller
{
    // عرض نموذج تسجيل الدخول
    public function showLoginForm() {
        return view('login'); // هننشئه في الخطوة الجاية
    }

    public function login(Request $request) {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            // Check role and redirect
            if($user->hasRole('admin')){
                return redirect()->route('home');
            } else {
                return redirect()->route('home')->with('message', 'Welcome! You don\'t have permission to access user management.');
            }
        }
        return back()->withErrors(['email' => 'Invalid login credentials']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    // CRUD Users
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create() {
        return view('users.create'); 
    }

    public function store(Request $request) {
        // Check for duplicate email
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('users.create')->with('error', 'Email already exists!');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);
        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('success','User created successfully!');
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        // Check for duplicate email (if changed)
        if ($request->email !== $user->email && User::where('email', $request->email)->exists()) {
            return redirect()->route('users.edit', $user)->with('error', 'Email already exists!');
        }
        
        $user->update([
            'name' => $request->name,
            'email'=> $request->email
        ]);
        $user->syncRoles([$request->role]);
        return redirect()->route('users.index')->with('success','User updated successfully!');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully!');
    }
}
