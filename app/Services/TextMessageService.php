<?php

namespace App\Services;

use App\Enums\TextMessageStatusEnum;
use App\Models\TextMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class TextMessageService
{
    public static function sendMessage(array $data, Collection $records): void
    {
        $textMessages = collect([]);

        $records->map(function ($record) use ($data, $textMessages) {
            $msg = self::sendTextMessage($record, $data);

            $textMessages->push($msg);
        });

        TextMessage::insert($textMessages->toArray());
    }

    public static function sendTextMessage(User $user, array $data): array
    {
        $message = Str::replace('{name}', $user->name, $data['message']);

        // send the message with API

        return [
            'message' => $message,
            'sent_by' => auth()?->id() ?? null,
            'status' => TextMessageStatusEnum::PENDING,
            'response' => '',
            'sent_to' => $user->id,
            'remarks' => $data['remarks'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
