<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100 dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BMA Library</title>
    <link rel="icon" href="{{ asset('images/logo.jfif') }}" type="image/jfif">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            height: 100%;
            margin: 0;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div>
        <!-- Header -->
        <header class="w-full z-50 bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg relative">
            <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Left Section -->
                    <div class="flex items-center gap-8">
                        <div>
                            <img class="h-8 w-8" src="{{ asset('images/logo.jfif') }}" alt="BMA Library Logo">
                        </div>
                        <nav class="hidden md:flex items-center gap-4">
                            <x-nav_link href="{{route('home')}}" :active="request()->is('/')">
                                <i class="fa-solid fa-house mr-1"></i> Home
                            </x-nav_link>
                            <x-nav_link href="{{route('books.index')}}" :active="request()->is('books')">
                                <i class="fa-solid fa-book mr-1"></i> Digital Books
                            </x-nav_link>
                            <x-nav_link href="{{route('physicalBooks.index')}}" :active="request()->is('physical-books')">
                                <i class="fa-solid fa-book mr-1"></i> Physical Books
                            </x-nav_link>
                            @auth
                            @if (Auth::user()->role === 'admin')
                            <x-nav_link href="{{route('admin.dashboard')}}" :active="request()->is('admin/dashboard')">
                                <i class="fa-solid fa-user-shield mr-1"></i> Dashboard
                            </x-nav_link>
                            @else
                            <x-nav_link href="{{route('user.dashboard')}}" :active="request()->is('dashboard')">
                                <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
                            </x-nav_link>
                            @endif
                            @endauth
                            <x-nav_link href="{{route('user.bookmarks.index')}}" :active="request()->is('bookmarks')">
                                <i class="fa-solid fa-bookmark mr-1"></i> Bookmarks
                            </x-nav_link>
                        </nav>
                    </div>

                    <!-- Right Section -->
                    <div class="hidden md:flex items-center space-x-2">
                        <div>
                            <a href="{{route('user.books.create')}}" class="relative text-white text-sm hover:bg-white hover:text-blue-600 rounded-lg py-1 px-2 transition-all">
                                <i class="fa-solid fa-plus text-sm mt-1"></i>
                                Upload Book
                            </a>
                        </div>

                        @guest
                        <a href="{{route('login')}}" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center transition-all">
                            <i class="fa-solid fa-sign-out-alt mr-1 text-xs"></i>
                            <p class="text-sm">Log In</p>
                        </a>
                        <a href="{{route('register')}}" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center transition-all">
                            <i class="fa-solid fa-user-plus mr-1 text-xs "></i>
                            <p class="text-sm">Register</p>
                        </a>
                        @endguest

                        @auth
                        <button id="dropdownButton" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center gap-1 transition-all">
                            <i class="fa-solid fa-user text-xs mr-1"></i>
                            <p class="text-sm">{{ Auth::user()->name }}</p>
                            <i class="fa-solid fa-chevron-circle-down text-xs mt-1"></i>
                        </button>
                        @endauth
                    </div>

                    <!-- Hamburger Button -->
                    <button id="menu-btn" class="block md:hidden text-white text-lg z-50 fixed top-4 right-4">
                        ☰
                    </button>

                    <!-- Mobile Dropdown Menu -->
                    <div id="mobile-menu" class="hidden absolute top-16 right-4 z-50 bg-white bg-opacity-90 backdrop-blur-md shadow-lg rounded-lg w-48 p-4">
                        <nav class="space-y-2">
                            <a href="{{route('home')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-house flex-shrink-0 w-5"></i> <span>Home</span>
                            </a>
                            @auth
                            @if (Auth::user()->role === 'admin')
                            <a href="{{route('admin.dashboard')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-user-shield flex-shrink-0 w-5"></i> <span>Dashboard</span>
                            </a>
                            <a href="{{route('admin.books.index')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-book flex-shrink-0 w-5"></i> <span>Manage Books</span>
                            </a>
                            <a href="{{route('admin.users.index')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-users flex-shrink-0 w-5"></i> <span>Manage Users</span>
                            </a>
                            @else
                            <a href="{{route('user.dashboard')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-tachometer-alt flex-shrink-0 w-5"></i> <span>Dashboard</span>
                            </a>
                            @endif
                            <form action="/logout" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                    <i class="fa-solid fa-sign-out-alt  w-5"></i> <span>Log Out</span>
                                </button>
                            </form>
                            @endauth
                            <a href="{{route('books.index')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-book flex-shrink-0 w-5"></i> <span>Books</span>
                            </a>
                            <a href="{{route('user.books.create')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-plus flex-shrink-0 w-5"></i> <span>Add Book</span>
                            </a>
                            <a href="{{route('user.bookmarks.index')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-bookmark flex-shrink-0 w-5"></i> <span>Bookmarks</span>
                            </a>
                        </nav>

                        @guest
                        <div class="space-y-2 mt-4">
                            <a href="{{route('login')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-sign-in-alt w-5"></i> <span>Log In</span>
                            </a>
                            <a href="{{route('register')}}" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2 transition-all">
                                <i class="fa-solid fa-user-plus w-5"></i> <span>Register</span>
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>
        <!-- session success message -->
        <x-session />


        <main>
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-200">
            <div class="container mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- About Us -->
                    <div class="max-w-md text-sm p-4">
                        <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                            About Us
                        </h1>
                        <div class="text-gray-600 flex flex-col gap-1">
                            <p>Welcome to the BMA Online Library, an exclusive digital resource for the staff of Bank-e-Mili Afghan (BMA). Our library offers a wide range of free educational digital books, all aimed at supporting the professional and personal development of our team.</p>
                        </div>
                    </div>

                    <!-- User Account -->
                    <div>
                        <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                            User Account
                        </h1>
                        <div class="flex flex-col gap-3 text-gray-600 text-sm">
                            @auth

                            @if (Auth::user()->role === 'admin')
                            <a href="{{route('admin.dashboard')}}" class="group transition-all">
                                <i class="fa-solid fa-tachometer-alt mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                            </a>

                            @else
                            <a href="{{route('user.dashboard')}}" class="group transition-all">
                                <i class="fa-solid fa-tachometer-alt mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                            </a>
                            @endif
                            <a href="{{route('user.books')}}" class="group transition-all">
                                <i class="fa-solid fa-book mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Manage Your Books</span>
                            </a>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="group transition-all">
                                    <i class="fa-solid fa-sign-out-alt"></i> <span class="group-hover:border-b group-hover:border-black">Log Out</span>
                                </button>
                            </form>
                            @endauth


                            @guest
                            <a href="{{route('books.index')}}" class="group transition-all">
                                <i class="fa-solid fa-book flex-shrink-0 w-5"></i>
                                <span class="group-hover:border-b group-hover:border-black">Books</span>
                            </a>
                            <a href="{{route('user.bookmarks.index')}}" class="group transition-all">
                                <i class="fa-solid fa-bookmark flex-shrink-0 w-5"></i> <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
                            </a>
                            <a href="{{route('user.books.create')}}" class="group transition-all">
                                <i class="fa-solid fa-plus flex-shrink-0 w-5"></i> <span class="group-hover:border-b group-hover:border-black">Add Book</span>
                            </a>
                            <a href="{{route('login')}}" class="group transition-all">
                                <i class="fa-solid fa-sign-in-alt mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Login</span>
                            </a>
                            <a href="{{route('register')}}" class="group transition-all">
                                <i class="fa-solid fa-user-plus mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Register</span>
                            </a>
                            @endguest
                        </div>
                    </div>

                    <!-- Follow Us -->
                    <div>
                        <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                            Follow Us
                        </h1>
                        <div class="flex gap-4 text-2xl">
                            <a href="https://www.facebook.com" class="text-gray-600 hover:text-blue-600 transition-all hover:scale-105" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.twitter.com" class="text-gray-600 hover:text-blue-400 transition-all hover:scale-105" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.youtube.com" class="text-gray-600 hover:text-red-600 transition-all hover:scale-105" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://www.instagram.com" class="text-gray-600 hover:text-pink-600 transition-all hover:scale-105" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.google.com" class="text-gray-600 hover:text-blue-600 transition-all hover:scale-105" target="_blank">
                                <i class="fab fa-google"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>