<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)
                      ->where('password', $request->password)
                      ->first();

        if ($admin) {

            session([
                'admin_logged_in' => true
            ]);

            return redirect('/admin/orders');
        }

        return back()->with('error', 'Username atau Password Salah');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');

        return redirect('/admin/login');
    }
}