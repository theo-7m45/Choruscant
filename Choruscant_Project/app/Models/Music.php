<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class Music extends Model
{
    protected $table = 'musics';

    protected $fillable = [
        'user_id',
        'title',
        'youtube_video_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}