<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkstrakulikulerSiswa extends Model
{
    protected $table = 'ekstrakulikuler_siswa';

    protected $fillable = [
        'ekstrakulikuler_id',
        'student_id',
        'year',
    ];

    public $timestamps = true;

    public function ekstrakulikuler()
    {
        return $this->belongsTo(Ekstrakulikuler::class, 'ekstrakulikuler_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
