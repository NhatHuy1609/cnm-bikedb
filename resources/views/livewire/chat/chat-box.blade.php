<div 
 x-data="{
    height:0,
    conversationElement:document.getElementById('conversation'),
    markAsRead:null,
    messageInput: null,
    loading: false
}"
x-init="
        height= conversationElement.scrollHeight;
        $nextTick(()=>conversationElement.scrollTop= height);
        
        Echo.private('users.{{Auth()->User()->id}}')
        .notification((notification)=>{
            if(notification['type']== 'App\\Notifications\\MessageRead' && notification['conversation_id']== {{$this->selectedConversation->id}})
            {

                markAsRead=true;
            }
        });
 "
@scroll-bottom.window="
 $nextTick(()=>
 conversationElement.scrollTop= conversationElement.scrollHeight
 );
 "
@reset-input.window="
 messageInput.value = '';
 "
class="w-full overflow-hidden">
    <div class="border-b flex flex-col overflow-y-scroll grow h-full">
    {{-- header --}}
    <header class="w-full sticky inset-x-0 flex pb-[5px] pt-[5px] top-0 z-10 bg-white border-b " >
        <div class="flex w-full items-center px-2 lg:px-4 gap-2 md:gap-5">
            <a class="shrink-0 lg:hidden" href="#">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                </svg>
            </a>
             <div class="shrink-0">
                <x-avatar class="h-9 w-9 lg:w-11 lg:h-11" />
            </div>

            <h6 class="font-bold truncate"> 
                 {{$selectedConversation->getReceiver()->email}}
            </h6>
        </div>
    </header>

    {{-- body --}}
    <main 
    @scroll="
        if(!loading && $el.scrollTop <= 0){
            loading = true;
            $wire.loadMore().then(() => {
                loading = false;
            });
        } 
    "
    @update-chat-height.window="
        newHeight = $el.scrollHeight;
        oldHeight = height;
        $el.scrollTop = newHeight - oldHeight;
        height = newHeight;
    "
    x-init="
        $nextTick(() => {
            conversationElement = $el;
            height = conversationElement.scrollHeight;
            conversationElement.scrollTop = height;
        });
    "
    id="conversation" 
    class="flex flex-col gap-3 p-2.5 overflow-y-auto flex-grow overscroll-contain overflow-x-hidden w-full my-auto"
>
        <div x-show="loading" class="text-center py-2">
            <span class="text-gray-500">Loading more messages...</span>
        </div>
        
        @if ($loadedMessages)
        @php
            $previousMessage= null;
        @endphp


        @foreach ($loadedMessages as $key=> $message)
            
        {{-- keep track of the previous message --}}
      
        @if ($key>0)

        @php
            $previousMessage= $loadedMessages->get($key-1)
        @endphp
            
        @endif
        <div 
        {{-- wire:key="{{time().$key}}" --}}
        @class([
            'max-w-[85%] md:max-w-[78%] flex w-auto gap-2 relative mt-2',
            'ml-auto'=>$message->sender_id=== auth()->id(),
                ]) >

        {{-- avatar --}}
        <div @class([
                    'shrink-0',
                    'invisible'=>$previousMessage?->sender_id==$message->sender_id,
                    'hidden'=>$message->sender_id === auth()->id()
                        ])>

            <x-avatar />
        </div>

        {{-- message body --}}
        
            <div @class(['flex flex-wrap text-[15px]  rounded-xl p-2.5 flex flex-col text-black bg-[#f6f6f8fb]',
                         'rounded-bl-none border  border-gray-200/40 '=>!($message->sender_id=== auth()->id()),
                         'rounded-br-none bg-blue-500/80 text-white'=>$message->sender_id=== auth()->id()
               ])>

                <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal">
                    {{$message->body}}
                    
                </p>

                <div class="ml-auto flex gap-2">
                    <p @class([
                    'text-xs ',
                    'text-gray-500'=>!($message->sender_id=== auth()->id()),
                    'text-white'=>$message->sender_id=== auth()->id(),

                        ]) >

                
                    {{$message->created_at->format('g:i a')}}

                    </p>

                    {{-- message status , only show if message belongs auth --}}
                    @if ($message->sender_id=== auth()->id())
          
                    <div x-data="{markAsRead:@json($message->isRead())}">

                        {{-- double ticks --}}

                        <span x-cloak x-show="markAsRead" @class('text-gray-200')>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                        </span>

                        {{-- single ticks --}}
                        <span x-show="!markAsRead" @class('text-gray-200')>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </span>
                    

                    </div>
                @endif
                </div>
            </div>

        </div>
        @endforeach
        @endif
    </main>

    {{-- send message  --}}
    <footer class="shrink-0 z-10 bg-white inset-x-0">
        <div class="p-2 border-t">
            <form wire:submit.prevent="sendMessage">
                <div class="grid grid-cols-12">
                    <input 
                        id="message-input"
                        wire:model.live="body" 
                        type="text"
                        class="col-span-10 bg-gray-100 border-0 outline-0 focus:border-0 focus:ring-0 hover:ring-0 rounded-lg focus:outline-none"
                    >

                    <button 
                        type="submit" 
                        class="col-span-2"
                    >
                        Send
                    </button>
                </div>
            </form>
            <p> 
                
                Message
            </p>
        </div>
    </footer>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('reset-input', () => {
            document.getElementById('message-input').value = '';
        });
    });
    window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log('Connected to Pusher!');
    });

    window.Echo.connector.pusher.connection.bind('error', (err) => {
        console.error('Pusher connection error:', err); 
    });
</script>