<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignLeads extends Model
{
    protected $table = "assign_leads";
    protected $fillable = ['id', 'lead_id', 'user_id'];
}
