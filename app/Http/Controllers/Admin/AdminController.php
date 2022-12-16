<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Absence;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $absences = Absence::where('presence_date', now())->get();

        return view('admin.dashboard', [
            'users' => User::all(),
            'positions' => Position::all(),
            'absences' => Absence::all(),
        ]);
    }
}
