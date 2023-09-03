<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory;
    protected $fillable = [
        'wirezone',
        'communication_key',
        'count',
        'app_name'
    ];

    protected $table = 'logger';
}
