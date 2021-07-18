<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;

    protected $collection = 'zip_codes';

    protected $fillable = [
        'value', 'city', 'state'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
