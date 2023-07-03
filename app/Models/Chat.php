<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat as BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends BaseModel
{
    protected $table = 'telegraph_chats';

    protected $fillable = [
        'chat_id',
        'name',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
