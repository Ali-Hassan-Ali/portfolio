<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Enums\ContactTypeEnum;
use App\Enums\ContactStatusEnum;

#[Fillable(['type', 'name', 'email', 'phone', 'company_name', 'activity_type', 'budget_range', 'project_scope', 'message', 'status'])]
class Contact extends Model
{
    use HasFactory;

    protected $casts = [
        'type'   => ContactTypeEnum::class,
        'status' => ContactStatusEnum::class,
    ];

    public function scopeNew($query)
    {
        return $query->where('status', ContactStatusEnum::NEW);
    }

    public function scopeRfq($query)
    {
        return $query->where('type', ContactTypeEnum::RFQ);
    }

    public function scopeQuick($query)
    {
        return $query->where('type', ContactTypeEnum::QUICK);
    }

}//end of model
