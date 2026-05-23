<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\OrderIndexScope;
use App\Models\Scopes\StatusScope;
use Spatie\Translatable\HasTranslations;

#[Fillable(['name', 'icon', 'description', 'status', 'admin_id'])]
class Service extends Model
{
    use HasFactory, HasTranslations;
    public array $translatable = ['name', 'description'];

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*services*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end of model
