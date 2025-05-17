<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AlluserController extends Controller
{
    // Validate user input (reused for store and update methods)
    private function validateUser($request, $id = null)
    {
        return $request->validate([
            'role' => 'required|string',  // Ensure role is a string (name)
            'company_id' => 'required|exists:companies,id',
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'emergency_mobile_number' => 'nullable|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'joining_date' => 'nullable|date',
            'id_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address' => 'required|string|max:500',
        ]);
    }

    // Display all users with their related data (company, role, department)
    public function index()
    {
        $data['users'] = User::with(['company', 'role', 'department'])->where('role', '!=', 'admin')->orderBy('id', 'desc')->paginate(50);
        $data['roles'] = Role::all();
        $data['companies'] = Company::all();
        $data['departments'] = Department::all();
        $data['designations'] = Role::all();

        return view('users.list', $data);
    }
    public function getuser(Request $request)
    {
        $data['users'] = User::with(['company', 'role', 'department'])->where('role', '!=', 'admin')->where('company_id',$request->id)->orderBy('id', 'desc')->paginate(50);
        $data['roles'] = Role::all();
        $data['companies'] = Company::all();
        $data['departments'] = Department::all();
        $data['designations'] = Role::all();

        return view('users.list', $data);
    }

    // Get roles based on selected company
    public function getRoles($id)
    {
        $roles = Role::where('company_id', $id)->get();
        return response()->json($roles);
    }

    // Get departments based on selected company
    public function getDepartmentsByCompany($id)
    {
        $departments = Department::where('company_id', $id)->get();
        $roles = Role::where('company_id', $id)->get();
        return response()->json(['roles' => $roles, 'departments' => $departments]);
    }

    // Show form for creating a new user
    public function create()
    {
        $companies = Company::all();
        $roles = Role::all();
        $departments = Department::all();

        return view('users.add', compact('companies', 'roles', 'departments'));
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request);

        // Find role by name and set role name
        $role = Role::where('role', $validatedData['role'])->first();
        if ($role) {
            $validatedData['role'] = $role->role;  // Store the role name instead of ID
        }

        // Find department by ID and set department name
        $department = Department::find($validatedData['department_id']);
        if ($department) {
            $validatedData['department'] = $department->department;  // Store the department name
        }

        // Hash the password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Handle file upload for ID proof
        if ($request->hasFile('id_proof')) {
            $validatedData['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        // Store the user data
        User::create($validatedData);
        return response()->json(['code' => 200, 'message' => $request->role . ' created successfully!']);
    }

    // Show the edit form for an existing user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $companies = Company::all();
        $roles = Role::all();
        $departments = Department::all();

        return view('users.edit', compact('user', 'companies', 'roles', 'departments'));
    }

    // Update an existing user in the database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input
        $validatedData = $this->validateUser($request, $id);

        // Find role by name and set role name
        $role = Role::where('role', $validatedData['role'])->first();
        if ($role) {
            $validatedData['role'] = $role->role; // Store the role name instead of ID
        }

        // Find department by ID and set department name
        $department = Department::find($validatedData['department_id']);
        if ($department) {
            $validatedData['department'] = $department->department; // Store the department name
        }

        // Hash password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        // Handle file upload for ID proof
        if ($request->hasFile('id_proof')) {
            $validatedData['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
        }

        // Update the user record
        $user->update($validatedData);
        return response()->json(['code' => 200, 'message' => $request->role . ' updated successfully!']);
    }

    // Delete a user from the database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('company.Alluser')->with('success', 'User deleted successfully.');
    }

    public function commanDelete(Request $request)
    {
        $type = $request->type;
        $table = $request->table;
        $id = $request->id;
        if ($type == 'delete') {
            DB::table($table)->whereId($id)->delete();

            return response()->json(['code' => 200, 'message' => $table . ' deleted successfully!']);
        }
    }
    public function filter(Request $request)
    {
        $users = User::query();

        if ($request->company_id) {
            $users->where('company_id', $request->company_id);
        }

        if ($request->department_id) {
            $users->where('department_id', $request->department_id);
        }

        if ($request->designation) {
            $users->where('role', $request->designation);
        }

         $users = $users->where('role','!=','admin')->get();

        return view('users.filter', compact('users'));
    }
}
