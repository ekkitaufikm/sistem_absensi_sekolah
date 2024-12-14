<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    use HasFactory;
    
    // Nama tabel
    protected $table = 'absensi';
    protected $fillable = [
        'user_id', 'latitude', 'longitude', 'waktu_masuk', 'waktu_pulang', 'today_date', 'clock_type_masuk', 'clock_type_pulang', 'created_at', 'updated_at'
    ];
    
    public function karyawan()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
