<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserWatchedVideo extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'video_title','tags','video_id','thumbnail_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
