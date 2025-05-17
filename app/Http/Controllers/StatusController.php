<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Company;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    // Display list of statuses and companies
    public function index()
    {
        // Get all companies and statuses with relationships
        $companies = Company::all();
        $status = Status::with('company')->orderby('id','desc')->get(); // Make sure Status model has a 'company' relationship

        return view('company.status', compact('companies', 'status'));
    }

    // Show form to create a new status
    public function create()
    {
        $companies = Company::all();
        return view('company.create_status', compact('companies'));
    }

    // Store new status in the database
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255|unique:status,status',
            'company_id' => 'required|exists:companies,id',
        ]);

        Status::create([
            'status' => $request->status,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.status.index')->with('success', 'Status created successfully!');
    }

    // Show form to edit an existing status
    public function edit(Status $status)
    {
        $companies = Company::all();
        return view('company.edit_status', compact('status', 'companies'));
    }

    // Update an existing status
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'status' => 'required|string|max:255|unique:status,status,' . $status->id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $status->update([
            'status' => $request->status,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('admin.status.index')->with('success', 'Status updated successfully!');
    }

    // Delete a status
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('admin.status.index')->with('success', 'Status deleted successfully!');
    }

    public function filter(Request $request)
    {
        $status = Status::with('company');
        if ($request->company_id) {
            $status->where('company_id', $request->company_id);
        }
        $status = $status->orderby('id','desc')->get();
        return view('company.status.filter', compact('status'));
    }
}
