<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class MessageView extends Component
{
    public $message = '';

    protected $listeners = [
        'echo:message,MessageReceived' => 'refresh_message'
    ];

    public function render()
    {
        $this->refresh_message();
        return view('livewire.message-view', ['message' => $this->message]);
    }

    public function refresh_message()
    {
        $message = Message::where('topic', 'sijaka/development/connection_AL207110')->first();
        $this->message = $message->message;
    }
}
