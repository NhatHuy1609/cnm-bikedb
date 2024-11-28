<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="author" content="Nhat Truong">
    <meta name="description" content="Admin Dashboard">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-family-karla flex">
    @include('admin.partials.sidebar')

    <div class="w-full flex flex-col h-screen">
        @include('admin.partials.header')
        
        <div class="w-full flex flex-col flex-grow overflow-x-hidden border-t">
            <main class="w-full flex-grow p-6">
                @yield('content')
            </main>

            @include('admin.partials.footer')
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>