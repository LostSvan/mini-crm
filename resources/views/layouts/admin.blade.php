<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <div class="w-full h-full">
        <header class="p-6 border-b-2 border-black">
            <div class="flex justify-between">
                <div class="font-bold">
                    Admin Panel
                </div>
                <div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="inline items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">Выход</button>
                    </form>
                </div>
            </div>
        </header>
        <main class="flex border-black border-b-2">
            @yield('content')
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>
