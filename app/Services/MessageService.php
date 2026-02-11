<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function getAllMessagesOfTalk(int $talkId)
    {
        return Message::select(
            'messages.*',
            'users.name as sender_name'
        )
            ->join('users', 'messages.sender_user_id', '=', 'users.id')
            ->where('talk_id', $talkId)
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }

    public function createMessageAndNotifyUser(
        int $senderUserId,
        int $talkId,
        string $content
    )
    {
        $messageModel = Message::create(
            [
                'sender_user_id' => $senderUserId,
                'talk_id' => $talkId,
                'content' => $content
            ]
        );

        event(
            new \App\Events\MessageSentEvent(
                receiverUserId: app(\App\Services\TalkService::class)->getReceiverUserId($senderUserId, $talkId)
            )
        );

        return $messageModel;
    }
}