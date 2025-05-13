<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Display the list of all companies and departments
    public function index()
    {
        $companies = Company::all();
        // Ensure correct casing of the model name (Department is capitalized)
        $departments = Department::all();

        return view('company.department', compact('companies', 'departments'));
    }

    // Show form to create a new department
    public function create()
    {
        return view('company.create_department');
    }

    // Store a new department in the database
    public function store(Request $request)

    {
        // Validate the incoming request
        $request->validate([
            'department' => 'required|string|max:255|unique:departments,department', // Fixed table name 'departments'
            'company_id' => 'required|exists:companies,id', // Ensure the company_id exists in the companies table
        ]);

        // Create a new department record in the database
        Department::create([
            'department' => $request->department,
            'company_id' => $request->company_id, // Ensure company_id field exists in the departments table
        ]);

        return redirect()->route('admin.department')->with('success', 'Department created successfully!');
    }

    // Show the edit form for an existing department
    public function edit(Department $department)
    {
        $companies = Company::all(); // To select a company in the edit form
        return view('company.edit_department', compact('department', 'companies'));
    }

    // Update an existing department's information
    public function update(Request $request, Department $department)
    {
        // Validate the incoming request with exception handling for uniqueness (excluding the current department)
        $request->validate([
            'department' => 'required|string|max:255|unique:department,department,' . $department->id,
            'company_id' => 'required|exists:companies,id', // Ensure the company_id exists
        ]);

        // Update the department record in the database
        $department->update([
            'department' => $request->department,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.department')->with('success', 'Department updated successfully!');
    }

    // Delete an existing department from the database
    public function destroy(Department $department)
    {
        $department->delete(); // Delete the department record
        return redirect()->route('admin.department')->with('success', 'Department deleted successfully!');
    }
}
