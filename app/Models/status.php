<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model{


    protected $table = 'status';
    protected $fillable = ['status', 'company_id'];


    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
}