<?php

namespace App\Models;

use App\Scopes\Published;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getThreadedComments()
    {
        return $this->comments()->with('user')->get()->threaded();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //search Scope
    public function scopeSearch(Builder $query, string $value): void
    {
        $query->where('title', 'like', "%$value%")->orWhere('body', 'like', "%$value%");
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Published());
    }
}
