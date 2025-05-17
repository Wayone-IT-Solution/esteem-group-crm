<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadModel extends Model
{
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id')->select('id', 'name');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'add_by')->select('id', 'name');
    }

    public function assinges()
    {
        return $this->hasMany(AssignLeads::class, 'lead_id', 'id');
    }
}
