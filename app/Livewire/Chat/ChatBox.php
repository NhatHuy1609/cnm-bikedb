<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageSent;
use App\Notifications\MessageRead;
use Illuminate\Support\Facades\Log;

class ChatBox extends Component
{
    public $selectedConversation;
    public $body = '';
    public $loadedMessages;
    public $paginate_var = 10;

    protected $rules = [
        'body' => 'required'
    ];

    protected $listeners = [
        'loadMore',
        'messageReceived' => 'handleNewMessage'
    ];

    public function getListeners()
    {
        $auth_id = auth()->id();
        Log::info('Current auth_id', ['auth_id' => $auth_id]);
        return [
            'loadMore',
            'newMessage',
            "echo-private:users.{$auth_id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotifications'
        ];

        
    }

    public function broadcastedNotifications($event)
    {        
        // Log::info('Received broadcast event', ['event' => $event]);  
        // dd($event);    
        if ($event['type'] === 'App\\Notifications\\MessageSent') {
            if ($event['conversation_id'] === $this->selectedConversation->id) {
                $newMessage = Message::find($event['message_id']);
                
                if (!$this->loadedMessages) {
                    $this->loadedMessages = collect();
                }
                
                $this->loadedMessages->push($newMessage);
                $this->dispatch('scroll-bottom');
                
                $newMessage->read_at = now();
                $newMessage->save();
                
                $this->selectedConversation->getReceiver()
                    ->notify(new MessageRead($this->selectedConversation->id));
            }
        }
    }

    public function loadMessages()
    {
        $userId = auth()->id();
        
        $this->loadedMessages = Message::where('conversation_id', $this->selectedConversation->id)
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->whereNull('sender_deleted_at');
            })->orWhere(function ($query) use ($userId) {
                $query->where('receiver_id', $userId)
                    ->whereNull('receiver_deleted_at');
            })
            ->latest()
            ->take($this->paginate_var)
            ->get()
            ->reverse();
    }

    public function sendMessage()
    {
        $this->validate();
        
        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedConversation->getReceiver()->id,
            'body' => $this->body
        ]);
        
        $this->body = '';
        
        if (!$this->loadedMessages) {
            $this->loadedMessages = collect();
        }

        $this->dispatch('scroll-bottom');
        
        $this->loadedMessages->push($createdMessage);

        $this->selectedConversation->updated_at = now();
        $this->selectedConversation->save();

        $this->dispatch('refresh')->to('chat.chat-list');

        $this->selectedConversation->getReceiver()
            ->notify(new MessageSent(
                Auth()->User(),
                $createdMessage,
                $this->selectedConversation,
                $this->selectedConversation->getReceiver()->id
            ));
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }

    public function handleNewMessage($notification)
    {
        if ($notification['conversation_id'] == $this->selectedConversation->id) {
            $this->loadMessages();
            $this->dispatch('scroll-bottom');
        }
    }

    public function newMessage($notification)
    {
        if ($notification['conversation_id'] == $this->selectedConversation->id) {
            $newMessage = Message::find($notification['message_id']);
            
            if (!$this->loadedMessages) {
                $this->loadedMessages = collect();
            }
            
            $this->loadedMessages->push($newMessage);
            $this->dispatch('scroll-bottom');
            
            $newMessage->update(['received_at' => now()]);
            
            $this->selectedConversation->getReceiver()
                ->notify(new MessageRead($this->selectedConversation->id));
        }
    }

    public function loadMore()
    {
        try {
            $this->loading = true;
            
            // Kiểm tra xem có selectedConversation không
            if (!$this->selectedConversation) {
                return;
            }

            // Lấy tin nhắn cũ hơn
            $messages = Message::where('conversation_id', $this->selectedConversation->id)
                ->where('id', '<', $this->loadedMessages->first()->id)
                ->orderBy('created_at', 'DESC')
                ->take($this->paginate_no)
                ->get();

            \Log::info('Loading more messages', [
                'conversation_id' => $this->selectedConversation->id,
                'messages_count' => $messages->count(),
                'last_message_id' => $this->loadedMessages->first()->id ?? null
            ]);

            // Nếu có tin nhắn
            if ($messages->count()) {
                // Thêm tin nhắn mới vào đầu collection
                $this->loadedMessages = $messages->reverse()->merge($this->loadedMessages);

                // Dispatch event để cập nhật chiều cao chat
                $this->dispatch('update-chat-height');
            }
        } catch (\Exception $e) {
            \Log::error('Error loading more messages: ' . $e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    public function mount($selectedConversation)
    {
        $this->selectedConversation = $selectedConversation;
        
        $this->loadedMessages = Message::where('conversation_id', $selectedConversation->id)
            ->orderBy('created_at', 'DESC')
            ->take($this->paginate_var)
            ->get()
            ->reverse();
    }
}
