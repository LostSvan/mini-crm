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
                        <button type="submit">Выход</button>
                    </form>
                </div>
            </div>
        </header>
        <main class="flex">
            @yield('content')
        </main>
        <footer>

        </footer>
    </div>
</body>
</html>
