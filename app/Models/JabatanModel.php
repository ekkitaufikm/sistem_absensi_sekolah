<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;
    
    // Nama tabel
    protected $table = 'm_jabatan';
    protected $fillable = [
        'nama', 'gaji'
    ];
}
