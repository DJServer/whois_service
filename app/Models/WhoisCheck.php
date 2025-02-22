<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoisCheck extends Model
{
    use HasFactory;

    protected $fillable = ['domain', 'whois_data'];

    protected $casts = [
        'whois_data' => 'string',
    ];
}
