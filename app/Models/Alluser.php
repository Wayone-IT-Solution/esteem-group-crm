<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;  // For password encryption
use Illuminate\Support\Facades\Storage;  // If you are saving file paths

class Alluser extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'all_users';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'unique_id', 'branch', 'department', 'designation', 'name',
        'address', 'email', 'mobile_number', 'emergency_mobile_number',
        'joining_date', 'company_id', 'role_id', 'password', 'id_proof'
    ];

    // Define attributes that should be cast to native types
    protected $casts = [
        'joining_date' => 'date',
    ];

    /**
     * Get the company associated with the user.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Set the password attribute and hash it before saving.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Set the id_proof attribute and handle the file upload.
     * You can customize this as per your file storage system (local, cloud, etc.).
     */
    public function setIdProofAttribute($value)
    {
        if (is_file($value)) {
            $this->attributes['id_proof'] = $value->store('id_proofs', 'public');
        } else {
            $this->attributes['id_proof'] = $value;
        }
    }
}
