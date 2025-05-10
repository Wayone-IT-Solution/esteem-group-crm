<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $departments = department::all(); // corrected model name casing

        return view('company.department', compact('companies', 'departments')); // fixed incorrect 'department'
    }

    public function create()
    {
        return view('company.create_department');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255|unique:department,department',
            'company_id' => 'required|exists:companies,id', // Assuming departments belong to companies
        ]);

        Department::create([
            'department' => $request->department,
            'company_id' => $request->company_id, // Ensure this field exists in the DB
        ]);

        return redirect()->route('admin.department')->with('success', 'Department created successfully!');
    }

    public function edit(Department $department)
    {
        $companies = Company::all(); // To select company in the edit form
        return view('company.edit_department', compact('department', 'companies'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department' => 'required|string|max:255|unique:department,department,' . $department->id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $department->update([
            'department' => $request->department,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.department')->with('success', 'Department updated successfully!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.department')->with('success', 'Department deleted successfully!');
    }
}