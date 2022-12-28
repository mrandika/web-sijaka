<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class MessageView extends Component
{
    public $message = '';

    protected $listeners = [
        'echo:message,MessageReceived' => '$refresh'
    ];

    public function render()
    {
        $message = Message::where('topic', 'sijaka/development/connection_AL207110')->first();
        $this->message = $message->message;

        return view('livewire.message-view', ['message' => $this->message])
            ->extends('layouts.sijaka-main')
            ->section('main');
    }
}
