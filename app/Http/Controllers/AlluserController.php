<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alluser;
use App\Models\Company;
use App\Models\Role;
use App\Models\Department; // Corrected: Use capitalized 'Department'
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlluserController extends Controller
{
    public function index()
    {
        // Fetch users with their associated company, role, and department
        $data['users'] = Alluser::with(['company', 'role', 'department'])->get();

        // Fetch all roles, companies, and departments
        $data['roles'] = Role::all();
        $data['companies'] = Company::all();
          $data['departments'] = Department::all();  // Corrected: 'Department' model name should be capitalized

        // Pass all necessary data to the view
        return view('company.Alluser', $data);
    }

    public function create()
    {
        // Fetch all companies and roles for creating a new user
        $companies = Company::all();
        $roles = Role::all();
        $departments = Department::all(); // Corrected: Use 'Department' instead of 'department'

        return view('company.Alluser_create', compact('companies', 'roles', 'departments'));  // Pass departments to the view
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',  // Corrected validation for department
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'emergency_mobile_number' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|unique:all_users,email',
            'joining_date' => 'nullable|date',
            'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address' => 'required|string|max:500',
        ]);

        // ✅ Safe unique ID generator
        do {
            $uniqueId = 'EMP' . Str::random(8);
        } while (Alluser::where('unique_id', $uniqueId)->exists());

        // Add unique_id to validated data
        $validatedData['unique_id'] = $uniqueId;

        // Handle file upload for ID proof
        if ($request->hasFile('id_proof')) {
            $validatedData['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create new user
        Alluser::create($validatedData);

        // Redirect with success message
        return redirect()->route('company.Alluser')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $user = Alluser::findOrFail($id);
        $companies = Company::all();
        $roles = Role::all();
        $departments = Department::all(); // Corrected: Use 'Department' instead of 'department'

        return view('company.users.edit', compact('user', 'companies', 'roles', 'departments')); // Pass departments to the view
    }

    public function update(Request $request, $id)
    {
        $user = Alluser::findOrFail($id);

        // Validate incoming request
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',  // Corrected validation for department
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'emergency_mobile_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:all_users,email,' . $id,
            'joining_date' => 'nullable|date',
            'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address' => 'required|string|max:500',
        ]);

        // Handle file upload for ID proof if it exists
        if ($request->hasFile('id_proof')) {
            $validatedData['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        // Check and update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validatedData['password'] = Hash::make($request->password);
        }

        // Update the user record
        $user->update($validatedData);

        // Redirect with success message
        return redirect()->route('company.Alluser')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = Alluser::findOrFail($id);
        $user->delete();

        return redirect()->route('company.Alluser')->with('success', 'User deleted successfully.');
    }
}