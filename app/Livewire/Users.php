<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Conversation;

class Users extends Component 
{
    public function message($userId){
        $authenticatedUserId = auth()->id();

        $existingConversation = Conversation::where(function ($query) use ($authenticatedUserId, $userId) {
                $query->where('sender_id', $authenticatedUserId)
                    ->where('receiver_id', $userId);
                })
            ->orWhere(function ($query) use ($authenticatedUserId, $userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $authenticatedUserId);
            })->first();

        # Redirect to existing conversation if it exists
        if ($existingConversation) {
            return redirect()->route('chat', ['query' => $existingConversation->id]);
        }

        # Create new conversation
        $createdConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId,
        ]);

        return redirect()->route('chat', ['query' => $createdConversation->id]);
    }
    public function render()
    {
        // Lấy user hiện tại
        $currentUser = auth()->user();
        
        if ($currentUser->role_id === 2) {
            // Nếu là role_id = 2, chỉ hiển thị users có role_id = 1
            $users = User::where('role_id', 1)->where('id', '!=', $currentUser->id)->get();
        } else {
            // Nếu là role_id = 1, hiển thị tất cả users trừ bản thân
            $users = User::where('id', '!=', $currentUser->id)->get();
        }

        return view('livewire.users', [
            'users' => $users
        ])->layout('layouts.app');
    }
}
