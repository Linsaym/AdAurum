<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'comment',
    ];

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
