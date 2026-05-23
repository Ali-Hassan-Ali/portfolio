<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\OrderIndexScope;
use App\Models\Scopes\StatusScope;

#[Fillable(['name', 'title', 'link', 'status', 'index', 'type', 'admin_id', 'parent_id'])]
class Menu extends Model
{
    use HasTranslations;
    public array $translatable = ['name'];

    public function scopeHeader($query)
    {
        return $query->where('type', \App\Enums\Admin\PageTypeEnum::HEADER)->whereNull('parent_id');
    }

    public function scopeFooter($query)
    {
        return $query->where('type', \App\Enums\Admin\PageTypeEnum::FOOTER)->whereNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($value) => now()->parse($value)->format('Y-m-d'));

    }//end of get createdAt Attribute

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderIndexScope);

        if(!request()->is('*menus*')) static::addGlobalScope(new StatusScope);

    }//end of Global Scope

}//end of model
