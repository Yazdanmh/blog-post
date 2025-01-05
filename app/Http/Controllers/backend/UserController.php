<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.index')
            ->with('users', User::paginate(10));
    }
    public function create()
    {
        return view('backend.users.create')
            ->with('roles', Role::all());
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'profile_pic' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $profile = new Profile();
        $profile->profile_pic = $request->profile_pic;
        $profile->user_id = $user->id;
        $profile->save();

        Session::flash('success', 'User created Successfully');
        return redirect()->route('users.index');
    }
}
