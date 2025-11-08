<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Installation extends Model
{
    protected $fillable = [
        'user_id',
        'installation_hash',
        'site_url',
        'package_version',
        'client_ip',
        'installation_code',
        'api_token',
        'api_token_enc',
        'sanctum_token_enc',
        'sanctum_token_hash',
    ];
    
    public function user()
    {   
        return $this->belongsTo(User::class);
    }
}
