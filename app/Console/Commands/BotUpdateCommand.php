<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\User;
use DefStudio\Telegraph\DTO\TelegramUpdate;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BotUpdateCommand extends Command
{
    protected $signature = 'bot:update';

    protected $description = 'Update user messages';

    public function handle()
    {
        $bot = TelegraphBot::query()->first();
        $messageIds = Message::query()->pluck('message_id')->toArray();

        $bot->updates()->each(function(TelegramUpdate $update) use ($messageIds, $bot) {
            if (in_array($update->message()->id(), $messageIds)) {
                return true;
            }

            $user = User::query()->where('username', $update->message()->from()->username())->first();

            if (!$user) {
                return true;
            }

            if ($document = $update->message()->document()) {
                $path = sprintf('documents/%s', $document->filename());

                $bot->store($document, Storage::path('public/documents'), $document->filename());
            }

            Message::query()->create([
                'message_id' => $update->message()->id(),
                'user_id' => $user->id,
                'message' => $update->message()->text(),
                'file' => $path ?? null,
            ]);
        });
    }
}
