<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bFlix</title>

    <link rel="stylesheet" href="/css/main.css">
    <link rel="shortcut icon" href="/images/Btext.png">
    <livewire:styles>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>
<body class="font-sans bg-black text-white">
    <nav class="sticky top-0 bg-black z-50">
        <div class="container mx-auto px-16 flex flex-col md:flex-row items-center justify-between py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index') }}">
                        <img src="/images/logo1.png" width="10%">
                    </a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('movies.index') }}">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('tv.index') }}">TV Show</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a class="hover:text-gray-300" href="{{ route('actors.index') }}">Actors</a>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                <livewire:search-drop-down>
                <div class="md:ml-4 mt-3 md:mt-0">
                    <a href="#">
                    <img src="{{asset('images/berry2.jpg')}}" alt="avatar" class="rounded-full w-8 h-8">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <livewire:scripts>
    @yield('scripts')
</body>
</html>