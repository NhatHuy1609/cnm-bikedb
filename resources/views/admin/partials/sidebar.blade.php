<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('admin.bikes.index') }}" 
           class="flex items-center {{ request()->routeIs('admin.bikes.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} text-white py-4 pl-6 nav-item">
            <i class="fas fa-bicycle mr-3"></i>
            Bikes
        </a>
        <a href="{{ route('admin.accessories.index') }}" 
           class="flex items-center {{ request()->routeIs('admin.accessories.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} text-white py-4 pl-6 nav-item">
            <i class="fas fa-cog mr-3"></i>
            Accessories
        </a>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} text-white py-4 pl-6 nav-item">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>
    </nav>
</aside>