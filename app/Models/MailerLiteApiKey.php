<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailerLiteApiKey extends Model
{
    use HasFactory;

    protected $table = 'mailer_lite_api_keys'; 

    protected $fillable = [
        'api_key',
    ];
}