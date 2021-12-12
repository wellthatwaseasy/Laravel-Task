<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <title>{{isset($pagetitle)?$pagetitle:'Tasks'}}</title>
</head>
<body class="bg-{{theme('bg')}}-200">
    @if (session('status'))
        <div>
            <div class="text-{{theme('success')}}-900 bg-{{theme('success')}}-50 p-6 m-2 mb-0 border-4 border-{{theme('success')}}-500 rounded-lg absolute z-10"
                style="opacity: 0.7;" onclick="parentNode.remove()" id="statusdiv">
                {{ session('status') }}
            </div>
        </div>
    @endif
    <nav class="p-3 bg-{{theme('bg')}}-50 flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a class="p-2" href=" {{ url('/home') }} ">Home</a>
            </li>
            <li>
                <a class="p-2" href=" {{ url('/posts') }} ">Posts</a>
            </li>
            <li>
                <a class="p-2" href=" {{ url('/tasks') }} ">Task</a>
            </li>
        </ul>
        <ul class="flex items-center">
            @auth
                <li>
                    <a class="p-2" href="">{{auth()->user()->name}} </a>
                </li>
                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type='submit' class="pl-3">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a class="p-2" href="{{ url('/login') }}">Login</a>
                </li>
                <li>
                    <a class="p-2" href="{{ url('/register') }} ">Register</a>
                </li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>
</html>
