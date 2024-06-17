<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuccessfulEmail extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'subject',
        'email',
        'raw_text',
        'to'
    ];

    
}
