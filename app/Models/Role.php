<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['role', 'company_id'];


    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
}
