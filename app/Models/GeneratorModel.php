<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratorModel extends Model
{
    use HasFactory;
    protected $table = 'licenses';
    protected $fillable = [
        'wireclue',
        'wirezone',
        'status',
        'communication_key',
        'software',
        'generated_by',
        'creation',
        'expiration'
    ];
}
