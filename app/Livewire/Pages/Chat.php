<?php

namespace App\Livewire\Pages;

use App\Services\UserService;
use App\Services\TalkService;
use Livewire\Component;
use App\Models\Talk;
use App\Models\User;

class Chat extends Component
{
    public string $highlightMessage = '';
    public string $newMessage = '';
    public $messages; //  type-hiting de \Illuminate\Database\Eloquent\Collection no Livewire gera erro.
    public $users;    // type-hiting de \Illuminate\Database\Eloquent\Collection no Livewire gera erro.
    public ?User $guestUser = null;
    public ?Talk $talk = null;

    public function render()
    {
        return view('livewire.pages.chat');
    }

    public function mount()
    {
        $this->messages = collect();
        $this->users = collect();
        $this->setTalk(null, null);
    }

    public function sendMessage()
    {
        if(is_null($this->guestUser) ){
            $this->highlightMessage = 'Você precisa selecionar um usuário para conversar';
            return;
        }

        if(empty(trim($this->newMessage)) ){
            $this->highlightMessage = 'Mensagem vazia';
            return;
        }

        app(\App\Services\MessageService::class)->createMessageAndNotifyUser(
            senderUserId: auth()->id(),
            talkId: $this->talk->id,
            content: $this->newMessage
        );

        $this->reset('newMessage');
        $this->setTalk(guestUserId: $this->guestUser->id);
    }

    public function setTalk(int|null $guestUserId)
    {   
        $this->users = app(UserService::class)->getOthrerUsers();

        if(is_null($guestUserId)){
            $this->highlightMessage = 'Click em algum usuário para iniciar o chat';
            $guestUserId = auth()->id();
        }else{
            $this->guestUser = $this->users->where('id', $guestUserId)->first();
            $this->highlightMessage = 'Conversando com ' . $this->guestUser->name;
            $guestUserId = $this->guestUser->id;
        }
        
     
        $this->talk = app(TalkService::class)->findOrCreateTalk(creatorUserId: auth()->id(), guestUserId: $guestUserId);
        $this->updateAllMessagesOfThisTalk();
    }

    public function getListeners()
    {
        $userId = auth()->id();
        // $talkId = $this->talk->id;


        return [
            "echo-private:receiver.{$userId},MessageSentEvent" => 'updateAllMessagesOfThisTalk',
        ];
    }

    public function updateAllMessagesOfThisTalk(): void
    {
        $this->messages = app(\App\Services\MessageService::class)->getAllMessagesOfTalk(talkId: $this->talk->id);
    }
}