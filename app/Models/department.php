<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{


    protected $table = 'departments';
    protected $fillable = ['department', 'company_id'];


    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
}
