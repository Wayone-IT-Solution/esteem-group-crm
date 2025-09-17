<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();
    $nzNowDate = Carbon::now('Pacific/Auckland')->toDateString();
    
    // Initialize variables to avoid undefined variable error
    $todayEnquiriesCount = 0;
    
    if ($user->role === 'admin') {
        $companies = Company::withCount([
            'users',
            'leads',
            'todayLeads' => function ($query) use ($nzNowDate) {
                $query->whereDate('created_at', $nzNowDate);
            },
        ])->with('status')->get();

        // Set todayEnquiriesCount for admin
        $todayEnquiriesCount = DB::connection('mysql2')
            ->table('loan_applications')
            ->whereDate('created_at', $nzNowDate)
            ->count();
    } else {
        $companies = Company::withCount([
            'users',
            'leads as leads_count' => function ($query) use ($user) {
                $query->whereHas('assinges', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            },
            'todayLeads as today_leads_count' => function ($query) use ($user, $nzNowDate) {
                $query->whereDate('created_at', $nzNowDate)
                    ->whereHas('assinges', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    });
            },
        ])->with('status')->get();

        // Set todayEnquiriesCount for non-admin users (if needed)
        try {
            $todayEnquiriesCount = DB::connection('mysql2')
                ->table('loan_applications')
                ->whereDate('created_at', $nzNowDate)
                ->where('user_id', $user->id)
                ->count();
        } catch (\Exception $e) {
            // If table doesn't exist or connection fails, keep default value
            $todayEnquiriesCount = 0;
        }
    }

    return view('dashboard', compact('companies', 'todayEnquiriesCount'));
}

    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        // Validate the single password field from your form
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

}
