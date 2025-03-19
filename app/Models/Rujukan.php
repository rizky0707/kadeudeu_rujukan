<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasien',
        'rujuk_pasien',
        'keterangan',
        'status',
    ];

    // Define a relationship to get the users associated with this rujukan
    public function users()
    {
        return $this->belongsTo(User::class,  'rujuk_pasien', 'approved_by', 'id');
    }

    public function getRujukPasienUsersAttribute()
{
    $userIds = explode(',', $this->rujuk_pasien); // Convert comma-separated string to array
    return User::whereIn('id', $userIds)->get(); // Fetch users as a collection
}

public function getApprovedByUsersAttribute()
{
    $userIds = explode(',', $this->approved_by); // Convert comma-separated string to array
    return User::whereIn('id', $userIds)->get(); // Fetch users as a collection
}



public function getApprovedByArrayAttribute()
{
    return $this->approved_by ? explode(',', $this->approved_by) : [];
}


}
