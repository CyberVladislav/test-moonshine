<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
}
