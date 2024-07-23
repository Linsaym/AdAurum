<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldComment extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'field_id',
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

    public function field(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CompanyField::class);
    }
}
