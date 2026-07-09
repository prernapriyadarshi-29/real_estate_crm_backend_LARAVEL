<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'specialization',
        'experience',
        'photo',
        'website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}