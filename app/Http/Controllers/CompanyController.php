<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RequestModel;
use App\Models\Status;
use App\Models\User;

class CompanyController extends Controller
{
    // Show the list of companies
    public function index()
    {
        $companies = Company::all();
        return view('company.list', compact('companies'));
    }

    // Show the form to create a new company
    public function create()
    {
        return view('company.create');
    }

    // Store a new company

    public function store(Request $request)
{
    // Check if the company name already exists
    $existingCompany = Company::where('name', $request->company_name)->first();

    if ($existingCompany) {
        return response()->json(['error' => 'A company with this name already exists. Please choose a different name.'], 400);
    }

    // Validation for file and company name
    $request->validate([
        'company_name' => 'required|string|max:255',
        'company_logo' => 'required|image|max:2048',
    ]);

    // Handle logo upload and save it to the 'public/uploads/logo' directory
    $logo = $request->file('company_logo');

    // Generate a unique file name to avoid overwriting files
    $logoName = uniqid() . '.' . $logo->getClientOriginalExtension();

    // Move the file to the 'public/uploads/logo' directory
    $logo->move(public_path('uploads/logo'), $logoName);

    // Save the logo file path to the database
    $logoPath = 'uploads/logo/' . $logoName;

    // Create the company
    $company = Company::create([
        'name' => $request->company_name,
        'logo' => $logoPath,
    ]);

    // Return company data as JSON response
    return response()->json([
        'company_id' => $company->id,
        'company_name' => $company->name,
        'company_logo_url' => asset($logoPath),
    ]);
}




    // Show the form to edit an existing company
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    // Update an existing company
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $company->name = $request->company_name;

        // Handle logo update if a new logo is uploaded
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logo', 'public');
            $company->logo = $logoPath;
        }

        $company->save();

        if ($request->ajax()) {
            return response()->json([
                'company_id' => $company->id,
                'company_name' => $company->name,
                'company_logo_url' => asset('storage/' . $company->logo),
            ]);
        }

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully!');
    }

    // Delete a company
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Delete logo file if exists
        $logoPath = public_path('storage/' . $company->logo);
        if (file_exists($logoPath)) {
            unlink($logoPath);
        }

        $company->delete();

        return redirect()->route('admin.companies')->with('success', 'Company deleted successfully!');
    }

    public function status(Request $request){
     $statuses=   Status::where('company_id',$request->id)->get();
     $requests=   RequestModel::where('company_id',$request->id)->get();
     $users  =  User::where('company_id',$request->id)->where('role','!=','admin')->get();

     return response()->json(['code'=>200,'statuses'=>$statuses,'requests'=>$requests,'users'=>$users]);
    }
}