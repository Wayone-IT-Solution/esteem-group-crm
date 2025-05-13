<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'company_id',
        'role',
        'department_id',
        'name',
        'email',
        'mobile_number',
        'emergency_mobile_number',
        'joining_date',
        'id_proof',
        'address',
        'password', // Ensure password is fillable
    ];

    // Hidden attributes to avoid exposing sensitive data
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting attribute types
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Use 'hashed' for password
        ];
    }

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}