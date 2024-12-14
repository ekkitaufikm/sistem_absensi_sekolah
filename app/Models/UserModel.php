<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'users';
    protected $guarded = ['id']; 
    
    public function role()
    { 
        return $this->belongsTo(RoleModel::class, 'm_role_id', 'id');
    }
    
    public function jabatan()
    { 
        return $this->belongsTo(JabatanModel::class, 'm_jabatan_id', 'id');
    }
}
