<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = ['name', 'logo'];

    public function users(){
        return $this->hasMany(User::class,'company_id');
    }

     public function leads(){
        return $this->hasMany(LeadModel::class,'company_id');
    }

     public function status(){
        return $this->hasMany(Status::class,'company_id');
    }

    public function todayLeads(){
                return $this->hasMany(LeadModel::class,'company_id')->whereDate('created_at',now());

    }

}