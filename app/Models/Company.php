<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'inn',
        'general_info',
        'ceo',
        'address',
        'phone',
    ];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CompanyComment::class);
    }

    public function fieldComments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FieldComment::class);
    }
}
