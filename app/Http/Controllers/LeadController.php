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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LeadController extends Controller
{
    //show leads table data

    public function todaysection()
    {
        $companies = Company::all();

        $leads = DB::connection('mysql2')->table('loan_applications')
            ->where(function ($q) {
                $columns = Schema::connection('mysql2')->getColumnListing('loan_applications');
                foreach ($columns as $column) {
                    if ($column != 'deleted_at') {
                        $q->orWhereNull($column);
                    }
                }
            })
            ->whereDate('created_at', now())->orderby('id', 'desc')->paginate(40);
        // return $leads;
        return view('leads.finance.loanqueries', compact('leads', 'companies'));
    }
    public function index()
    {
        $user = auth()->user();

        // Admin ko sab leads dikhani hain
        if ($user->role == 'admin') {
            $leads = LeadModel::with(['company', 'user', 'assinges'])
                ->orderBy("created_at", "desc")
                ->paginate(40);
        } else {
            // Dusre users ko sirf assigned leads dikhani hain
            $leads = LeadModel::with(['company', 'user', 'assinges'])
                ->whereHas('assinges', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orderBy("created_at", "desc")
                ->paginate(40);
        }

        $companies = Company::all();

        return view('leads.list', compact('leads', 'companies'));
    }

    public function getleads(Request $request)
    {
        $user = auth()->user();

        $query = LeadModel::with(['company', 'user', 'assinges'])
            ->orderBy("created_at", "desc");

        $query->where('company_id', $request->company_id);
        // }
        $companies = Company::all();

        $query->where('status', $request->status);
        if ($request->status === 'Lead') {

            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason']; // exclude these fields

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));

        }

        if ($request->status === 'Qualified lead') {

            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where('lead_status', 'Qualified Lead')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason', 'status'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNotNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));

        }

        if ($user->role !== 'admin') {
            $query->whereHas('assinges', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $leads = $query->paginate(40);

        return view('leads.list', [
            'leads'           => $leads,
            'companies'       => $companies,
            'company_id'      => $request->company_id,
            'isCompanyLocked' => false,
        ]);

    }

    public function getleadsAll(Request $request)
    {
        $user = auth()->user();

        $query = LeadModel::with(['company', 'user', 'assinges'])
            ->orderBy("created_at", "desc");

        $query->where('company_id', $request->company_id);
        // }
        $companies = Company::all();

        if ($request->status === 'Lead') {

            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason']; // exclude these fields

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));

        }

        if ($request->status === 'Qualified lead') {

            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where('lead_status', 'Qualified Lead')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason', 'status'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNotNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));

        }

        if ($user->role !== 'admin') {
            $query->whereHas('assinges', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $leads = $query->paginate(40);

        return view('leads.list', [
            'leads'           => $leads,
            'companies'       => $companies,
            'company_id'      => $request->company_id,
            'isCompanyLocked' => true,
        ]);

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

        $leads     = $query->orderBy("created_at", "desc")->paginate(40);
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'mobile_number' => 'required|string|max:20',
            'requestfor'    => 'required|string|max:255',
            'status'        => 'required|string',
            'state'         => 'required|string',
            'description'   => 'nullable|string',
        ]);

        // Prepare data
        $save = [
            'name'          => $request->name,
            'email'         => $request->email,
            'address'       => $request->address,
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'request'       => $request->requestfor,
            'status'        => $request->status,
            'state'         => $request->state,
            'source'        => $request->source,
            'company_id'    => $request->company_id,
            'description'   => $request->description,
            'created_at'    => now(),
            'add_by'        => Auth::user()->id,
            'unique_id'     => $this->getlastGFCode('lead_models'),
        ];

        // Example: Insert into DB
        $leadId = DB::table('lead_models')->insertGetId($save);

        if ($leadId) {
            if (! empty($request->users)) {
                DB::table('assign_leads')->insert([
                    'lead_id'    => $leadId,
                    'status'     => $request->status,
                    'user_id'    => $request->users,
                    'created_at' => now(),
                    'add_by'     => Auth::user()->id,

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

        if (! empty($lastEntry) && ! empty($lastEntry->unique_id)) {
            $lastNumber = (int) str_replace($prefix, '', $lastEntry->unique_id);
            $newId      = $prefix . ($lastNumber + 1);
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

        // Add search by name or mobile number
        if ($request->filled('search')) {
            $search = $request->search;
            $leads->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('mobile_number', 'like', '%' . $search . '%');
            });
        }

        // Handle different date scenarios
        if ($request->filled('fromDate') && $request->filled('toDate')) {
            $leads->whereBetween('created_at', [$request->fromDate, $request->toDate]);
        } elseif ($request->filled('fromDate')) {
            $leads->whereDate('created_at', $request->fromDate);
        } elseif ($request->filled('toDate')) {
            $leads->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('source')) {
            $leads->where('source', 'like', '%' . $request->source . '%');
        }

        $leads = $leads->latest()->get();
        $table = view('leads.filter', compact('leads'))->render();

        return response()->json(['code' => 200, 'table' => $table]);
    }

//   public function filterEnquires(Request $request)
// {
//     $query = LeadModel::with(['company', 'user', 'assinges']);

//     if ($request->company_id) {
//         $query->where('company_id', $request->company_id);
//     }

//     if ($request->search) {
//         $query->where(function ($q) use ($request) {
//             $q->where('name', 'like', '%' . $request->search . '%')
//               ->orWhere('mobile_number', 'like', '%' . $request->search . '%');
//         });
//     }

//     if ($request->fromDate && $request->toDate) {
//         $query->whereBetween(DB::raw('DATE(created_at)'), [$request->fromDate, $request->toDate]);
//     }

//     if (!$request->company_id && !$request->search && !$request->fromDate && !$request->toDate) {
//         $query->whereDate('created_at', today());
//     }

//     $leads = $query->latest()->get();

//     $table = view('leads.filterEnquires', compact('leads'))->render();

//     return response()->json(['code' => 200, 'table' => $table]);
// }
    public function filterEnquires(Request $request)
    {
        $query = LeadModel::with(['company', 'user', 'assinges']);

        if ($request->company_id) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('mobile_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$request->from_date, $request->to_date]);
        }

        //  Show today's leads only if NO filters are applied
        if (
            ! $request->company_id &&
            ! $request->search &&
            ! $request->from_date &&
            ! $request->to_date &&
            ! $request->user_id
        ) {
            $query->whereDate('created_at', today());
        }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        //  Restrict if not admin
        $user = auth()->user();
        if ($user->role !== 'admin') {
            $query->whereHas('assinges', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $leads = $query->latest()->get();

        $table = view('leads.filterEnquires', compact('leads'))->render();

        return response()->json(['code' => 200, 'table' => $table]);
    }

    // public function edit(Request $request)
    // {

    //     $lead      = LeadModel::with(['company', 'user', 'assinges'])->find($request->lead);
    //     $companies = Company::all();
    //     $status    = Status::where('company_id', $lead->company_id)->get();
    //     $users     = User::where('company_id', $lead->company_id)->get();

    //     // Initialize empty collections
    //     $loansByStatus   = collect();
    //     $queriesByStatus = collect();

    //     if ($lead && $lead->mobile_number) {
    //         // Get all loan applications
    //         $allLoans = DB::connection('mysql2')->table('loan_applications')
    //             ->where('mobile', $lead->mobile_number)
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         // Group loans by status
    //         $loansByStatus = $allLoans->groupBy('status');

    //         // Get all loan queries for these loans
    //         $allQueries = DB::connection('mysql2')->table('loan_queries')
    //             ->whereIn('loan_application_id', $allLoans->pluck('id')->toArray())
    //             ->orderBy('created_at', 'desc')
    //             ->get();

    //         // Group queries by their own status
    //         if ($allQueries->isNotEmpty()) {
    //             $queriesByStatus = $allQueries->groupBy('status');
    //         }
    //     }
    //     // return $loansByStatus;

    //     return view('leads.edit', compact(
    //         'companies',
    //         'lead',
    //         'status',
    //         'users',
    //         'loansByStatus',
    //         'queriesByStatus'
    //     ));
    // }
    public function edit(Request $request)
    {
        $lead      = LeadModel::with(['company', 'user', 'assinges'])->find($request->lead);
        $companies = Company::all();
        $status    = Status::where('company_id', $lead->company_id)->get();
        $users     = User::where('company_id', $lead->company_id)->get();

        //
        // if (! empty($lead) && $lead->company_id == 7 && strtolower($lead->status) === 'enquiry') {
        //     $whatsappNumber = preg_replace('/\D/', '', $lead->mobile_number); // Clean and format
        //     $templateName   = 'thankyou';
        //     $broadcastName  = 'thankyou';
        //     $watiToken      = 'YOUR_WATI_API_TOKEN'; // Replace with actual token

        //     try {
        //         $response = Http::withToken($watiToken)
        //             ->withHeaders([
        //                 'Content-Type' => 'application/json',
        //             ])
        //             ->post("https://live-mt-server.wati.io/425322/api/v1/sendTemplateMessage?whatsappNumber={$whatsappNumber}", [
        //                 'template_name'  => $templateName,
        //                 'broadcast_name' => $broadcastName,
        //             ]);

        //         if ($response->successful()) {
        //             Log::info("WATI WhatsApp message sent to {$whatsappNumber}");
        //         } else {
        //             Log::error("WATI Error: " . $response->body());
        //         }
        //     } catch (\Exception $e) {
        //         Log::error("WATI Exception: " . $e->getMessage());
        //     }
        // }

        // Loan & Query loading
        $loansByStatus   = collect();
        $queriesByStatus = collect();

        if ($lead && $lead->mobile_number) {
            $allLoans = DB::connection('mysql2')->table('esteem_loan_applications')
                ->where('mobile', $lead->mobile_number)
                ->orderBy('created_at', 'desc')
                ->get();

            $loansByStatus = $allLoans->groupBy('status');

            $allQueries = DB::connection('mysql2')->table('esteem_loan_queries')
                ->whereIn('loan_application_id', $allLoans->pluck('id')->toArray())
                ->orderBy('created_at', 'desc')
                ->get();

            if ($allQueries->isNotEmpty()) {
                $queriesByStatus = $allQueries->groupBy('status');
            }
        }

        return view('leads.edit', compact(
            'companies',
            'lead',
            'status',
            'users',
            'loansByStatus',
            'queriesByStatus'
        ));
    }

    public function update(Request $request, $id)
    {
        $lead = LeadModel::findOrFail($id);

        $request->validate([
            'company_id'    => 'required',
            'requestfor'    => 'required',
            'status'        => 'required',
            'name'          => 'required',
            'email'         => 'required|email',
            'mobile_number' => 'required',
            'source'        => 'required',
            'state'         => 'required',
            'address'       => 'required',
            'description'   => 'required',
            'users'         => 'required',
        ]);

        $lead->update([
            'company_id'    => $request->company_id,
            'requestfor'    => $request->requestfor,
            'status'        => $request->status,
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'source'        => $request->source,
            'state'         => $request->state,
            'address'       => $request->address,
            'description'   => $request->description,
            'assigned_to'   => $request->users,
        ]);

        return redirect()->route('all-leads')->with('success', 'Lead updated successfully.');
    }

    public function description(Request $request)
    {
        $lead = LeadModel::findOrFail($request->lead_id);

        $save = [
            'lead_id'       => $request->lead_id,
            'status'        => $request->status,
            'add_by'        => Auth::user()->id,
            'description'   => $request->description,
            'next_followup' => $request->next_followup,
            'created_at'    => now(),
        ];
        LeadFollowup::insert($save);

        LeadModel::where('id', $request->lead_id)->update([
            'status'      => $request->status,
            'description' => $request->description,
        ]);

        // if ($lead->company_id == 7 && strtolower($request->status) === 'qualified lead') {
        //     $whatsappNumber = '918505822089';
        //     // $whatsappNumber = preg_replace('/\D/', '', $lead->mobile_number);
        //     $templateName  = 'thankyou';
        //     $broadcastName = 'thankyou';
        //     $watiToken     = env('WATI_API_TOKEN');
        //     try {
        //         $response = Http::withToken($watiToken)
        //             ->withHeaders(['Content-Type' => 'application/json'])
        //             ->post("https://live-mt-server.wati.io/425322/api/v1/sendTemplateMessage?whatsappNumber={$whatsappNumber}", [
        //                 'template_name'  => $templateName,
        //                 'broadcast_name' => $broadcastName,
        //             ]);

        //         Log::info("📤 WATI WhatsApp Sent Attempt", [
        //             'number'      => $whatsappNumber,
        //             'status_code' => $response->status(),
        //             'response'    => $response->body(),
        //         ]);

        //         if ($response->successful()) {
        //             Log::info("✅ WhatsApp message sent via WATI", [
        //                 'lead_id'         => $lead->id,
        //                 'whatsapp_number' => $whatsappNumber,
        //                 'status'          => $request->status,
        //                 'company_id'      => $lead->company_id,
        //                 'response_status' => $response->status(),
        //                 'response_body'   => $response->body(),
        //             ]);
        //         } else {
        //             Log::error("❌ Failed to send WhatsApp via WATI", [
        //                 'lead_id'         => $lead->id,
        //                 'status_code'     => $response->status(),
        //                 'response_body'   => $response->body(),
        //                 'json_response'   => $response->json(),
        //                 'whatsapp_number' => $whatsappNumber,
        //             ]);
        //         }
        //     } catch (\Exception $e) {
        //         Log::error("❌ Exception while sending WhatsApp via WATI", [
        //             'lead_id'         => $lead->id,
        //             'error'           => $e->getMessage(),
        //             'whatsapp_number' => $whatsappNumber,
        //         ]);
        //     }
        // }

        if ($request->filled('user_id')) {
            $exist = DB::table('assign_leads')
                ->where('lead_id', $request->lead_id)
                ->where('user_id', $request->user_id)
                ->first();

            if (empty($exist)) {
                DB::table('assign_leads')->insert([
                    'lead_id'    => $request->lead_id,
                    'status'     => $request->status,
                    'user_id'    => $request->user_id,
                    'created_at' => now(),
                    'add_by'     => Auth::user()->id,
                ]);
            }
        }

        return response()->json(['code' => 200, 'message' => 'Lead Status updated successfully!']);
    }

    public function canvas(Request $request)
    {
        $leadCon = LeadFollowup::with('user')->where('lead_id', $request->id)->orderby('id', 'desc')->get();

        return view('leads.canvas', compact('leadCon'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $file   = $request->file('excel_file');
            $reader = IOFactory::createReaderForFile($file);
            $reader->setReadDataOnly(true); // ✅ Avoid formulas, styles
            $spreadsheet = $reader->load($file);
            $sheet       = $spreadsheet->getActiveSheet();
            $rows        = $sheet->toArray(null, true, true, true);
        } catch (\Throwable $e) {
            return back()->with('error', 'Error reading the Excel file. Please check the format.');
        }

        // ✅ Expected header keys
        $expectedHeaders = [
            "S. No",
            "Platform",
            "Full Name",
            "Phone ",
            "Email",
            "City",
            "what_is_your_earning_criteria_?",
            "which_type_of_licence_you_are_holding?",
            "what_is_the_source_of_your_income?",
            "what_is_the_required_amount_of_your_loan?",
            "please_share_your_license/_version_number_with_us.",
        ];

        $headerRow    = array_shift($rows); // Get and remove first row (header)
        $headerValues = array_values($headerRow);
        $cleanHeader  = array_slice($headerValues, 0, count($expectedHeaders));

        $normalize = fn($arr) => array_map(fn($v) => strtolower(trim((string) $v)), $arr);

        if ($normalize($cleanHeader) !== $normalize($expectedHeaders)) {
            return back()->with('error', 'Excel header mismatch. Please use the correct template.');
        }

        foreach ($rows as $row) {
            $values = array_values($row);

            // ✅ Skip completely empty/null rows
            if (! array_filter($values)) {
                continue;
            }

            $rowData = array_slice($values, 0, count($expectedHeaders));

            LeadModel::insert([
                'company_id'       => $request->company_id,
                'source'           => $rowData[1] ?? null,
                'name'             => $rowData[2] ?? null,
                'mobile_number'    => $rowData[3] ?? null,
                'email'            => $rowData[4] ?? null,
                'state'            => $rowData[5] ?? null,
                'earning_criteria' => $rowData[6] ?? null,
                'status'           => ($rowData[6] === 'b)_above_500_$') ? 'Qualified lead' : 'Enquiry',
                'license_type'     => $rowData[7] ?? null,
                'income_source'    => $rowData[8] ?? null,
                'required_amount'  => $rowData[9] ?? null,
                'license_version'  => $rowData[10] ?? null,
                'add_by'           => Auth::id(),
                'created_at'       => now(),
                'unique_id'        => $this->getlastGFCode('lead_models'),
            ]);
        }

        return back()->with('success', 'Leads imported successfully!');
    }

    public function secondconnection()
    {
        return DB::connection('mysql2')->table('loan_applications')->get();
    }

    public function updateStatus(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'id'     => 'required|integer|exists:mysql2.loan_applications,id',
            'status' => 'required|string',
        ]);

        $loanApplication = DB::connection('mysql2')
            ->table('loan_applications')
            ->where('id', $request->id)->first();

        // check the status that is comming
        DB::connection('mysql2')
            ->table('loan_applications')
            ->where('id', $request->id)
            ->update([
                'status'     => $request->status,
                'updated_at' => now(),
            ]);

        // check if request has comment
        if ($request->has('description')) {
            DB::connection('mysql2')
                ->table('loan_queries_comment')->insert(['description' => $request->description, 'user_id' => Auth::user()->id, 'created_at' => now(), 'loan_id' => $request->id]);
        }

        $accessToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxNGM4OTU5NS1jNGZlLTQwZWUtYWYwNy05ODVmYTVkMDUyODIiLCJ1bmlxdWVfbmFtZSI6ImVzdGVlbWZpbmFuY2U3QGdtYWlsLmNvbSIsIm5hbWVpZCI6ImVzdGVlbWZpbmFuY2U3QGdtYWlsLmNvbSIsImVtYWlsIjoiZXN0ZWVtZmluYW5jZTdAZ21haWwuY29tIiwiYXV0aF90aW1lIjoiMDQvMDMvMjAyNSAwNzo0NToxOSIsInRlbmFudF9pZCI6IjQyNTMyMiIsImRiX25hbWUiOiJtdC1wcm9kLVRlbmFudHMiLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJBRE1JTklTVFJBVE9SIiwiZXhwIjoyNTM0MDIzMDA4MDAsImlzcyI6IkNsYXJlX0FJIiwiYXVkIjoiQ2xhcmVfQUkifQ.sfPB9WoIoxjNoqE5ku1TVmHgSSDnCn31xlFT5Vakvvc";
        $accountId   = '425322'; // default fallback
        $baseUrl     = 'https://live-mt-server.wati.io';

        $countryCode = ltrim((string) ($loanApplication->country_code ?? ''), '+');

                                                              // Now build the full E.164-style number
        $fullPhone = $countryCode . $loanApplication->mobile; // ← use "." not "+"
        $mobile    = $fullPhone;

        $status      = $request->status;
        $url         = "{$baseUrl}/{$accountId}/api/v1/sendTemplateMessage?whatsappNumber={$mobile}";
        $trackingUrl = 'https://esteemfinance.co.nz/apply-for-car-loan?id=' . $request->id;

        $payload = [];
        $name    = $loanApplication->title . ' ' . $loanApplication->first_name . ' ' . $loanApplication->last_name;
        $reason  = $request->reason ?? '';

        if ($status === 'eligible') {
            $payload = [
                'template_name'  => 'sent_form',
                'broadcast_name' => 'sent_form_' . now()->format('dmYHi'),
                'parameters'     => [
                    ['name' => 'name', 'value' => $name],
                    ['name' => 'tracking_url', 'value' => $trackingUrl],
                ],
            ];
        } else {
            if ($status === 'not eligible') {
                $payload = [
                    'template_name'  => 'notekigible_with_reason',
                    'broadcast_name' => 'notekigible_with_reason_' . now()->format('dmYHi'),
                    'parameters'     => [
                        ['name' => 'name', 'value' => $name],
                        ['name' => 'order_number', 'value' => $reason],
                    ],
                ];
            }
        }

        if (in_array($status, ['not eligible', 'eligible'])) {

            $response = Http::withToken($accessToken)
                ->post($url, $payload);
        }

        return redirect()->back()->with('success', 'Loan status updated successfully.');
    }

    public function financeFilter(Request $request)
    {
        $loanLeads = DB::connection('mysql2')->table('loan_applications');

        if ($request->filled('search')) {
            $search = $request->search;
            $loanLeads->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        if ($request->filled('fromDate') && $request->filled('toDate')) {
            $loanLeads->whereBetween('created_at', [$request->fromDate, $request->toDate]);
        } elseif ($request->filled('fromDate')) {
            $loanLeads->whereDate('created_at', $request->fromDate);
        } elseif ($request->filled('toDate')) {
            $loanLeads->whereDate('created_at', '<=', $request->toDate);
        }

        if ($request->filled('status')) {
            $loanLeads->where('status', $request->status);
        }

        $loanLeads = $loanLeads->latest()->get();

        $table = view('leads.finance.filter', compact('loanLeads'))->render();

        return response()->json(['code' => 200, 'table' => $table]);
    }

    public function editUpdateStatus(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'id'     => 'required|integer|exists:mysql2.loan_applications,id',
            'status' => 'required|string',
        ]);

        DB::connection('mysql2')
            ->table('loan_applications')
            ->where('id', $request->id)
            ->update([
                'status'     => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Loan status updated successfully.');
    }

    public function loanComments(Request $request)
    {
        $comments = DB::connection('mysql2')->table('loan_queries_comment')
            ->where('loan_id', $request->id)
            ->orderByDesc('created_at')
            ->get();

        // Get user IDs
        $userIds = $comments->pluck('user_id')->filter()->unique()->toArray();

        // Get user names from default connection
        $users = DB::table('users')
            ->whereIn('id', $userIds)
            ->pluck('name', 'id');

        // Attach user names to comments
        $comments->transform(function ($comment) use ($users) {
            $comment->user_name = $users[$comment->user_id] ?? 'Unknown';
            return $comment;
        });

        return response()->json(['comments' => $comments]);
    }

    public function editLeads($id)
    {
        // Fetch loan data from mysql2
        $loan = DB::connection('mysql2')->table('loan_applications')->where('id', $id)->first();

        if (! $loan) {
            return redirect()->back()->with('error', 'Loan not found.');
        }

        $companies = Company::all();
        // return $loan;

        return view('leads.finance.edit', compact('loan', 'companies'));
    }

    public function updateLoan(Request $request, $id)
    {

        $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'nullable|email',
            'mobile'         => 'nullable|string|max:20',
            'loan_amount'    => 'nullable|numeric',
            'weekly_payment' => 'nullable|numeric',
            'term_years'     => 'nullable|numeric',
            'title'          => 'nullable|string|max:255',
            'date_of_birth'  => 'nullable|date',
            // 'company_id'     => 'nullable|integer',
            'status'         => 'nullable|string|max:100',
        ]);

        $updated = DB::connection('mysql2')->table('loan_applications')
            ->where('id', $id)
            ->update([
                'first_name'     => $request->first_name,
                'last_name'      => $request->last_name,
                'email'          => $request->email,
                'mobile'         => $request->mobile,
                'loan_amount'    => $request->loan_amount !== '' ? $request->loan_amount : null,
                'weekly_payment' => $request->weekly_payment !== '' ? $request->weekly_payment : null,
                'term_years'     => $request->term_years !== '' ? $request->term_years : null,
                'title'          => $request->title,
                'date_of_birth'  => $request->date_of_birth,
                // 'company_id'     => $request->company_id !== '' ? $request->company_id : null,
                'status'         => $request->status,
                'updated_at'     => now(),
            ]);

        if ($updated) {
            return redirect()->route('admin.leads.finance.edit', $id)
                ->with('success', 'Loan updated successfully!');
        } else {
            return redirect()->back()->with('error', 'No changes made or update failed.');
        }
    }

    public function todayleads($company_id, Request $request)
    {
        $query = LeadModel::with(['company', 'user', 'assinges'])
            ->whereDate('created_at', now());

        // if ($request->filled('company_id')) {
        $query->where('company_id', $request->company_id)->whereDate('created_at', now());
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

        $leads     = $query->orderBy("created_at", "desc")->paginate(40);
        $companies = Company::all();

        return view('leads.list-today', compact('leads', 'companies'));
    }

    public function getcompanytodayleads($company_id, Request $request)
    {
        $user = auth()->user();

        $excluded = ['deleted_at', 'disapproval_reason']; // Define excluded fields

        // Base query from mysql2
        $query = DB::connection('mysql2')->table('loan_applications')
            ->whereDate('created_at', now())
            ->where(function ($q) use ($excluded) {
                $columns = Schema::connection('mysql2')->getColumnListing('loan_applications');

                foreach ($columns as $column) {
                    if (! in_array($column, $excluded)) {
                        $q->orWhereNull($column);
                    }
                }
            });

        // Optional user filter
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Restrict to logged-in user if not admin
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $leads     = $query->orderBy("id", "desc")->paginate(40);
        $companies = Company::all();

        return view('leads.leads-today', compact('leads', 'companies'));
    }

    public function getNullEnquires(Request $request)
    {
        $user = auth()->user();

        $query = LeadModel::with(['company', 'user', 'assinges'])
            ->where('source', '_')
            ->orderBy("created_at", "desc");

        $query->where('company_id', $request->company_id);
        $companies = Company::all();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->status === 'Lead') {
            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));
        }

        if ($request->status === 'Qualified lead') {
            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where('lead_status', 'Qualified Lead')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason', 'status'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNotNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));
        }

        if ($user->role !== 'admin') {
            $query->whereHas('assinges', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $leads = $query->paginate(40);

        return view('leads.list', [
            'leads'           => $leads,
            'companies'       => $companies,
            'company_id'      => $request->company_id,
            'isCompanyLocked' => false,
        ]);
    }

    public function getSMEnquires(Request $request)
    {
        $user = auth()->user();

        $query = LeadModel::with(['company', 'user', 'assinges'])
            ->where('source', '!=', '_')
            ->orderBy("created_at", "desc");

        $query->where('company_id', $request->company_id);
        $companies = Company::all();

        if ($request->status === 'Lead') {
            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));
        }

        if ($request->status === 'Qualified lead') {
            $leads = DB::connection('mysql2')->table('loan_applications')
                ->where('lead_status', 'Qualified Lead')
                ->where(function ($q) {
                    $columns  = Schema::connection('mysql2')->getColumnListing('loan_applications');
                    $excluded = ['deleted_at', 'disapproval_reason', 'status'];

                    foreach ($columns as $column) {
                        if (! in_array($column, $excluded)) {
                            $q->orWhereNotNull($column);
                        }
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(40);

            return view('leads.finance.loanqueries', compact('leads', 'companies'));
        }

        if ($user->role !== 'admin') {
            $query->whereHas('assinges', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $leads = $query->paginate(40);

        return view('leads.list', [
            'leads'           => $leads,
            'companies'       => $companies,
            'company_id'      => $request->company_id,
            'isCompanyLocked' => false,
        ]);
    }

}
