<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'address',
        'price',
        'city',
        'type',
        'description',
        'bedrooms',
        'status',
        'photo',
    ];

    /**
     * Property belongs to one User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}