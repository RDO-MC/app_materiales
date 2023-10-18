<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class RolerController extends Controller
{
    public function showRegistrationForm()
{
    $roles = Role::all();
    return view('auth.register', compact('roles'));
}
}



