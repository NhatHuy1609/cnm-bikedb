<div class="max-w-6xl mx-auto my-16">
    <!-- Tiêu đề -->
    <h5 class="text-center text-4xl font-bold py-6 text-gray-800">Chat với Admin</h5>
    <p class="text-center text-gray-500 mb-10">Nhấn vào nút để bắt đầu trò chuyện với Admin. Hỗ trợ luôn sẵn sàng!</p>

    <!-- Lưới người dùng -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-4">
        @foreach ($users as $user)
        @if($user->id !== auth()->id())
        <div class="group relative w-full bg-white border border-gray-200 rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow">
            <!-- Avatar -->
            <div class="flex flex-col items-center text-center">
                <img src="https://avatar.iran.liara.run/username?username={{$user->name}}" 
                     alt="Avatar" 
                     class="w-20 h-20 mb-3 rounded-full shadow-md transition-transform group-hover:scale-105">
                
                <!-- Thông tin người dùng -->
                <h5 class="text-lg font-semibold text-gray-800">{{$user->name}}</h5>
                <span class="text-sm text-gray-500">{{$user->email}}</span>

                <!-- Nút hành động -->
                <button wire:click="message({{$user->id}})" 
                        class="mt-4 px-6 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                    Bắt đầu chat
                </button>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
