<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user      = auth()->user();
        $nzNowDate = Carbon::now('Pacific/Auckland')->toDateString();

        if ($user->role === 'admin') {
            $companies = Company::withCount([
                'users',
                'leads',
                'todayLeads' => function ($query) use ($nzNowDate) {
                    $query->whereDate('created_at', $nzNowDate);
                },
            ])->with('status')->get();

            $todayEnquiriesCount = DB::connection('mysql2')
                ->table('loan_applications')
                ->whereDate('created_at', $nzNowDate)
                ->count();
        } else {
            $companies = Company::withCount([
                'users',
                'leads as leads_count'            => function ($query) use ($user) {
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

            $todayEnquiriesCount = DB::connection('mysql2')
                ->table('loan_applications')
                ->whereDate('created_at', $nzNowDate)
                ->where('user_id', $user->id)
                ->count();
        }

        return view('dashboard', compact('companies', 'todayEnquiriesCount'));
    }
}
