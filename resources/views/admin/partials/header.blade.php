<!-- Desktop Header -->
<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2">
        <h1 class="text-2xl font-semibold">
            @if(request()->is('admin/bikes*'))
                Bikes
            @elseif(request()->is('admin/accessories*')) 
                Accessories
            @elseif(request()->is('admin/dashboard*'))
                Users
            @else
                Dashboard
            @endif
        </h1>
    </div>
    <div x-data="{ isOpen: false, isProfileModalOpen: false }" class="relative w-1/2 flex justify-end">
        <!-- User Menu Button -->
        <button @click="isOpen = !isOpen" 
                class="realtive z-10 w-10 h-10 rounded-full overflow-hidden border-2 border-gray-300 hover:border-gray-400 focus:border-gray-400 focus:outline-none">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff" 
                 alt="{{ auth()->user()->name }}">
        </button>
        
        <!-- Backdrop -->
        <button x-show="isOpen" 
                @click="isOpen = false" 
                class="h-full w-full fixed inset-0 cursor-default"></button>
        
        <!-- Dropdown Menu -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-14">
            <button @click="isProfileModalOpen = true; isOpen = false" 
                    class="block w-full text-left px-4 py-2 account-link hover:text-white">
                <i class="fas fa-user mr-2"></i> Profile
            </button>
            <a href="{{ route('logout') }}" class="block w-full text-left px-4 py-2 account-link hover:text-white">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>

        <!-- Profile Modal -->
        <div x-show="isProfileModalOpen" 
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <!-- Backdrop -->
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal Content -->
                <div class="relative bg-white rounded-lg max-w-md w-full mx-auto shadow-xl" 
                     @click.away="isProfileModalOpen = false">
                    <div class="px-6 py-4">
                        <div class="text-lg font-medium text-gray-900 mb-4">Profile Information</div>
                        
                        <!-- Profile Content -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->name }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1 text-sm text-gray-900">{{ auth()->user()->email }}</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <div class="mt-1 text-sm text-gray-900">Administrator</div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Member Since</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    {{ auth()->user()->created_at->format('F d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end">
                        <button type="button" 
                                @click="isProfileModalOpen = false"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <a href="/admin" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>

    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="/admin/bikes" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-bicycle mr-3"></i>
            Bikes
        </a>
        <a href="/admin/accessories" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-list mr-3"></i>
            Accessories
        </a>
        <a href="/admin/users" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>
        <div class="border-t border-gray-200 mt-4 pt-4">
            <button x-data="{ isProfileModalOpen: false }" 
                    @click="isProfileModalOpen = true"
                    class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">
                <i class="fas fa-user mr-3"></i>
                Profile
            </button>
            <a href="{{ route('logout') }}" 
               class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </div>
    </nav>
</header>