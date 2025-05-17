<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadFollowup extends Model
{
    protected $table = "followups";
    protected $fillable = ['id','lead_id','status','add_by','description','next_followup'];

  public function user()
    {
        return $this->hasOne(User::class, 'id', 'add_by');
    
}
}
