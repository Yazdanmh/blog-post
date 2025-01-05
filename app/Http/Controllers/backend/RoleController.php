<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index()
    {
        return view('backend.role.index')
            ->with('roles', Role::paginate(10));
    }
    public function create()
    {
        return view('backend.role.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Role::create(['name' => $request->name]);
        Session::flash('success', 'Role created Successfully');
        return redirect()->route('role.index');
    }
    public function show($role)
    {
        return view('backend.role.show')
            ->with('permissions', Permission::all())
            ->with('role_id', $role);
    }

    public function update(Request $request, $role)
    {
        $request->validate([
            'permission' => 'required|array'
        ]);

        $role = Role::find($role);
        $role->permissions()->attach($request->permission);
        Session::flash('success', 'Permissions successfully updated for role' . $role->name);
        return redirect()->route('role.index');
    }
}
