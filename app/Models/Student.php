<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'nomor_hp',
        'NISN',
        'alamat',
        'jenis_kelamin',
        'foto',
    ];

    public $timestamps = false;
}
