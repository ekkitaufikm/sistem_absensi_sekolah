<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    use HasFactory;
    
    // Nama tabel
    protected $table = 'm_shift';
    protected $fillable = [
        'user_id', 'nama', 'periode', 'jam_awal', 'jam_akhir', 'created_by', 'updated_by'
    ];
    
    public function karyawan()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
