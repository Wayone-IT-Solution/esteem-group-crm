<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;  // For password encryption
use Illuminate\Support\Facades\Storage;  // For file storage

class Alluser extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'users';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'unique_id', 'branch', 'department', 'designation', 'name',
        'address', 'email', 'mobile_number', 'emergency_mobile_number',
        'joining_date', 'company_id', 'role_id', 'department_id', 'password', 'id_proof'
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
     * Get the department associated with the user.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
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
            // Save file in 'id_proofs' directory within the 'public' disk
            $this->attributes['id_proof'] = $value->store('id_proofs', 'public');
        } else {
            $this->attributes['id_proof'] = $value;
        }
    }

    /**
     * Set the role ID and store role name in the 'role' column.
     * This ensures the role is stored by name instead of the role ID.
     */
    public function setRoleAttribute($value)
    {
        // Find the role by name
        $role = Role::where('role', $value)->first();
        if ($role) {
            // Save role ID and role name
            $this->attributes['role_id'] = $role->id;
            $this->attributes['role'] = $role->role;
        } else {
            $this->attributes['role_id'] = null; // Set to null if no role found
            $this->attributes['role'] = null;    // Set to null if no role found
        }
    }

    /**
     * Set the department ID and store department name in the 'department' column.
     * This ensures the department is stored by name instead of the department ID.
     */
    public function setDepartmentAttribute($value)
    {
        // Find the department by name
        $department = Department::where('department', $value)->first();
        if ($department) {
            // Save department ID and department name
            $this->attributes['department_id'] = $department->id;
            $this->attributes['department'] = $department->department;
        } else {
            $this->attributes['department_id'] = null; // Set to null if no department found
            $this->attributes['department'] = null;    // Set to null if no department found
        }
    }

    /**
     * Accessor for the role attribute. Returns the role name.
     */
    public function getRoleAttribute($value)
    {
        return $value;
    }

    /**
     * Accessor for the department attribute. Returns the department name.
     */
    public function getDepartmentAttribute($value)
    {
        return $value;
    }
}