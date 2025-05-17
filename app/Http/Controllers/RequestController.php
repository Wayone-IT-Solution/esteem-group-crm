<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\RequestModel;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $requests = RequestModel::with('company')->orderBy('id', 'desc')->get();

        return view('request.list', compact('companies', 'requests'));
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
        $validatedData = $request->validate([
            'request' => 'required|string|max:255|unique:requests,request', // Assume column is 'request'
            'company_id' => 'required|exists:companies,id',
        ]);

        // Create a new request record in the database
        RequestModel::create([
            'request' => $validatedData['request'],
            'company_id' => $validatedData['company_id'],
        ]);

        return redirect()->route('admin.request.all')->with('success', 'Request created successfully!');
    }


    // Show the edit form for an existing department
    public function edit(Department $department)
    {
        $companies = Company::all(); // To select a company in the edit form
        return view('company.edit_department', compact('department', 'companies'));
    }

    // Update an existing department's information
    public function update(Request $request, RequestModel $requestModel)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'request' => 'required|string|max:255|unique:requests,request,' . $requestModel->id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $save = [
            'request' => $validatedData['request'],
            'company_id' => $validatedData['company_id'],

        ];


        RequestModel::where('id', $request->id)->update($save);


        return redirect()->route('admin.request.all')->with('success', 'Request updated successfully!');
    }

    // Delete an existing department from the database
    
    public function filter(Request $request)
    {
        $query = RequestModel::query();
        if ($request->company_id) {
            $query->where('company_id', $request->company_id);
        }

        $requests = $query->get();

        return view('request.filter', compact('requests'));
    }
}
