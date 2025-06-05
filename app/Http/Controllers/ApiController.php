<?php

namespace App\Http\Controllers;

use App\Models\LeadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function webhook(Request $request)
    {
        $data = [
            'company_id' => 7,
            'source' => 'fb',
            'name' => $request->name,
            'mobile_number' => $request->mobile,
            'email' =>  $request->email,
            'state' => $request->state,
            'earning_criteria' => $request->earning_criteria,
            'status' => ($request->earning_criteria === 'b)_above_500_$') ? 'Qualified lead' : 'Enquiry',
            'license_type' => $request->license_type ?? null,
            'income_source' => $request->income_source ?? null,
            'required_amount' => $request->required_amount ?? null,
            'license_version' => $request->license_version ?? null,
            'add_by' => 4,
            'created_at' => now(),
            'unique_id' => $this->getlastGFCode('lead_models'),
        ];

        $query =    LeadModel::insert($data);
        if ($query) {
            return response()->json(['message' => 'Lead Added successfully'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
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
}
