<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LeadFollowup;
use App\Models\LeadModel;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadAssignedMail;

class LeadController extends Controller
{
  //show leads table data
  public function index()
  {
    $user = auth()->user();

    // Admin ko sab leads dikhani hain
    if ($user->role == 'admin') {
      $leads = LeadModel::with(['company', 'user', 'assinges'])
        ->orderBy("created_at", "desc")
        ->paginate(10);
    } else {
      // Dusre users ko sirf assigned leads dikhani hain
      $leads = LeadModel::with(['company', 'user', 'assinges'])
        ->whereHas('assinges', function ($query) use ($user) {
          $query->where('user_id', $user->id);
        })
        ->orderBy("created_at", "desc")
        ->paginate(10);
    }

    $companies = Company::all();

    return view('leads.list', compact('leads', 'companies'));
  }


  public function getleads(Request $request)
  {
    $user = auth()->user();

    $query = LeadModel::with(['company', 'user', 'assinges'])
      ->orderBy("created_at", "desc");

    // Company ID filter
    // if ($request->filled('company_id')) {
    $query->where('company_id', $request->company_id);
    // }

    // Status filter
    $query->where('status', $request->status);


    // Role-based filtering
    if ($user->role !== 'admin') {
      $query->whereHas('assinges', function ($q) use ($user) {
        $q->where('user_id', $user->id);
      });
    }

    $leads = $query->paginate(10);
    $companies = Company::all();

    return view('leads.list', compact('leads', 'companies'));
  }

  public function todayleads(Request $request)
  {
    $query = LeadModel::with(['company', 'user', 'assinges'])
      ->whereDate('created_at', now());

    // if ($request->filled('company_id')) {
    $query->where('company_id', $request->company_id);
    // }

    if ($request->filled('user_id')) {
    $query->where('user_id', $request->user_id);
    }

    $user = auth()->user();

    if ($user->role !== 'admin') {
      $query->whereHas('assinges', function ($q) use ($user) {
        $q->where('user_id', $user->id);
      });
    }


    $leads = $query->orderBy("created_at", "desc")->paginate(10);
    $companies = Company::all();

    return view('leads.list', compact('leads', 'companies'));
  }

  public function getallcompanyleads(Request $request)
  {

        $user = auth()->user();

    $query = LeadModel::with(['company', 'user', 'assinges']);

    // if ($request->filled('company_id')) {
    $query->where('company_id', $request->company_id);
    // }

    // if ($request->filled('user_id')) {
    // $query->where('user_id', $request->user_id);
    // }

    
    if ($user->role !== 'admin') {
      $query->whereHas('assinges', function ($q) use ($user) {
        $q->where('user_id', $user->id);
      });
    }

    $leads = $query->orderBy("created_at", "desc")->paginate(10);
    $companies = Company::all();

    return view('leads.list', compact('leads', 'companies'));
  }

  public function create()
  {
    $companies = Company::all();
    return view('leads.add', compact('companies'));
  }
  public function store(Request $request)
  {
    // Optional: Add validation if needed
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'mobile_number' => 'required|string|max:20',
      'requestfor' => 'required|string|max:255',
      'status' => 'required|string',
      'state' => 'required|string',
      'description' => 'nullable|string',
    ]);

    // Prepare data
    $save = [
      'name' => $request->name,
      'email' => $request->email,
      'address' => $request->address,
      'email' => $request->email,
      'mobile_number' => $request->mobile_number,
      'request' => $request->requestfor,
      'status' => $request->status,
      'state' => $request->state,
      'source' => $request->source,
      'company_id' => $request->company_id,
      'description' => $request->description,
      'created_at' => now(),
      'add_by' => Auth::user()->id,
      'unique_id' => $this->getlastGFCode('lead_models'),
    ];

    // Example: Insert into DB
    $leadId  =    DB::table('lead_models')->insertGetId($save);

    if ($leadId) {
      if (!empty($request->users)) {
        DB::table('assign_leads')->insert([
          'lead_id' => $leadId,
          'status' => $request->status,
          'user_id' => $request->users,
          'created_at' => now(),
          'add_by' => Auth::user()->id,

        ]);

        // $user = DB::table('users')->where('id', $request->users)->first();
        // if ($user && $user->email) {
        //   Mail::to($user->email)->send(new LeadAssignedMail($user->name));
        // }
      }
    }

    // Return response
    return response()->json(['code' => 200, 'message' => 'Lead Created successfully!']);
  }

  public function getlastGFCode($table)
  {
    $prefix = 'EG-';
    if ($table === 'users') {
      $prefix = 'EMGF-';
    }

    $lastEntry = DB::table($table)
      ->orderByDesc('id')
      ->select('unique_id')
      ->first();

    if (!empty($lastEntry) && !empty($lastEntry->unique_id)) {
      $lastNumber = (int) str_replace($prefix, '', $lastEntry->unique_id);
      $newId = $prefix . ($lastNumber + 1);
    } else {
      $newId = $prefix . '100';
    }

    return $newId;
  }
  public function filter(Request $request)
  {
    $leads = LeadModel::with(['company', 'user', 'assinges']);

    if ($request->filled('company_id')) {
      $leads->where('company_id', $request->company_id);
    }

    if ($request->filled('status')) {
      $leads->where('status', $request->status);
    }

    // Handle different date scenarios
    if ($request->filled('fromDate') && $request->filled('toDate')) {
      $leads->whereBetween('created_at', [$request->fromDate, $request->toDate]);
    } elseif ($request->filled('fromDate')) {
      $leads->whereDate('created_at', $request->fromDate);
    } elseif ($request->filled('toDate')) {
      $leads->whereDate('created_at', '<=', $request->to_date);
    }

    $leads = $leads->latest()->get();
    $table = view('leads.filter', compact('leads'))->render();

    return response()->json(['code' => 200, 'table' => $table]);
  }



  public function edit(Request $request)
  {
    $lead =   LeadModel::with(['company', 'user', 'assinges'])->find($request->lead);
    $companies = Company::all();
    $status =  Status::where('company_id', $lead->company_id)->get();
    $users =  User::where('company_id', $lead->company_id)->get();
    return view('leads.edit', compact('companies', 'lead', 'status', 'users'));
  }

  public function update(Request $request, $id)
  {
    $lead = LeadModel::findOrFail($id);

    $request->validate([
      'company_id' => 'required',
      'requestfor' => 'required',
      'status' => 'required',
      'name' => 'required',
      'email' => 'required|email',
      'mobile_number' => 'required',
      'source' => 'required',
      'state' => 'required',
      'address' => 'required',
      'description' => 'required',
      'users' => 'required',
    ]);

    $lead->update([
      'company_id' => $request->company_id,
      'requestfor' => $request->requestfor,
      'status' => $request->status,
      'name' => $request->name,
      'email' => $request->email,
      'mobile_number' => $request->mobile_number,
      'source' => $request->source,
      'state' => $request->state,
      'address' => $request->address,
      'description' => $request->description,
      'assigned_to' => $request->users,
    ]);

    return redirect()->route('all-leads')->with('success', 'Lead updated successfully.');
  }

  public function description(Request $request)
  {
    $save  =
      [
        'lead_id' => $request->lead_id,
        'status' => $request->status,
        'add_by' => Auth::user()->id,
        'description' => $request->description,
        'next_followup' => $request->next_followup,
        'created_at' => now(),
      ];
    LeadFollowup::insert($save);
    LeadModel::where('id', $request->lead_id)->update(['status' => $request->status, 'description' => $request->description]);

    if ($request->filled('user_id')) {
      // check if the same user exist with same lead or noit
      $exist =  DB::table('assign_leads')->where('lead_id', $request->lead_id)->where('user_id', $request->user_id)->first();

      if (empty($exist)) {
        DB::table('assign_leads')->insert(['lead_id' => $request->lead_id, 'status' => $request->status, 'user_id' => $request->user_id, 'created_at' => now(), 'add_by' => Auth::user()->id]);
      }
    }
    return  response()->json(['code' => 200, 'message' => 'Lead Status updated successfully!']);
  }

  public function canvas(Request $request)
  {
    $leadCon =  LeadFollowup::with('user')->where('lead_id', $request->id)->orderby('id', 'desc')->get();

    return view('leads.canvas', compact('leadCon'));
  }
}
