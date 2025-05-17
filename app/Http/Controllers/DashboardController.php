<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        // Admin: show all users, leads, today leads
        $companies = Company::withCount([
            'users',
            'leads',
            'todayLeads'
        ])->with('status')->get();
    } else {
        // Non-admin: only show leads assigned to this user
         $companies = Company::withCount([
            'users',
            'leads as leads_count' => function ($query) use ($user) {
                $query->whereHas('assinges', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            },
            'todayLeads as today_leads_count' => function ($query) use ($user) {
                $query->whereDate('created_at', now())
                      ->whereHas('assinges', function ($q) use ($user) {
                          $q->where('user_id', $user->id);
                      });
            }
        ])->with('status')->get();
    }

    return view('dashboard', compact('companies'));
}

}
