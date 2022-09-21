<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory;

    public const STATUSES = ['new', 'active', 'blocked', 'finished'];

    protected $table = 'deals';

    protected $fillable = [
        'title',
        'note',
        'additional_files',
        'status',
        'ad_id',
        'user_id',
    ];

    protected $casts = [
        'status' => ' boolean'
    ];

    /* Relations */

    //Сделки (deals) всегда выбираются с отзывами (reviews)
    protected $with = ['reviews'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'deal_id', 'id');
    }

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ad_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
