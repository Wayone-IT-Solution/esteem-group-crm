<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // public function index()
    // {
    //     // Fetch all roles with company name as plain text
    //      $roles = Role::with('company')->get();
    //     $companies = Company::all();
        
    //     return view('company.roles', compact('roles', 'companies'));
    // }
    public function index()
{
    // Fetch roles with associated company and paginate results
    $roles = Role::with('company')->paginate(10); // Show 10 roles per page
    $companies = Company::all();
    
    return view('company.roles', compact('roles', 'companies'));
}


    public function create()
    {
        return view('roles.create'); // No need to pass companies
    }

    public function store(Request $request)
    {
        // Validate role and company name as plain text
        $request->validate([
            'company_id' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        Role::create([
            'company_id' => $request->company_id,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role')); // No companies passed
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'company_id' => 'required',
            'role' => 'required|string|max:255|unique:roles,role,' . $role->id,
        ]);

        $role->update([
            'company_id' => $request->company_id,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully!');
    }
}
