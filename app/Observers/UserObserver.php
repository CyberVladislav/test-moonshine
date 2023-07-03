<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\File;

class UserObserver
{
    public function deleting(User $user)
    {
        $user->messages()->whereNotNull('file')->eachById(function ($message) {
            $path = storage_path($message->file);

            if (File::exists($path)) {
                File::delete($path);
            }
        });
    }
}
