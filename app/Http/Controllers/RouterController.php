<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->position->name === 'Admin') {
            return redirect(route('admin.dashboard'));
        } else {
            return redirect(route('employe.dashboard'));
        }
    }

    public function profile()
    {
        if (auth()->user()->position->name === 'Admin') {
            return redirect(route('admin.profile.edit'));
        } else {
            return redirect(route('employe.profile.edit'));
        }
    }
}
