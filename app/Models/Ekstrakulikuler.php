<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = 'ekstrakulikuler';

    protected $fillable = [
        'nama',
    ];

    public $timestamps = true;
}
