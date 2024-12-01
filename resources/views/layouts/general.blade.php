<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Bootstrap 3.3.7 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/ionicons@4.1.1/dist/css/ionicons.min.css">

    <!-- Build Main CSS -->
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/base.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <link href="//bizweb.dktcdn.net/100/066/626/themes/919897/assets/ant-sport.scss.css?1730193558341" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/userheader-style.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-100">
        @include('general.components.header')

        <main class='flex w-full bg-white px-16 py-6'>
            @include('general.components.sidebar')
            <section class="container mx-auto px-4 py-8 flex-1">
                @yield('content')
            </section>
        </main>

        @include('general.components.footer')
    </div>
</body>

</html>