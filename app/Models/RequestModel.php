<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $fillable = ['id', 'request', 'company_id'];
    protected $table = 'requests';


    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
