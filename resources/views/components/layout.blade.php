<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BMA library</title>
    <link rel="icon" href="{{ asset('images/logo.jfif') }}" type="image/jfif">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            height: 100%;
            margin: 0;
        }

        ;
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-full">
        <header class="w-full z-50 bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg relative">
            <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Left Section -->
                    <div class="flex items-center gap-8">
                        <div>
                            <img class="h-8 w-8" src="{{ asset('images/logo.jfif') }}" alt="Your Company">
                        </div>
                        <nav class="hidden md:flex items-center gap-4">
                            <x-nav_link href="/" :active="request()->is('/')">
                                <i class="fa-solid fa-house mr-1"></i> Home
                            </x-nav_link>
                            @auth
                            @if (Auth::user()->role === 'admin')
                            <x-nav_link href="/admin/dashboard" :active="request()->is('admin/dashboard')">
                                <i class="fa-solid fa-user-shield mr-1"></i> Admin Dashboard
                            </x-nav_link>
                            @else
                            <x-nav_link href="/dashboard" :active="request()->is('users')">
                                <i class="fa-solid fa-tachometer-alt mr-2"></i> Dashboard
                            </x-nav_link>
                            @endif
                            @endauth
                            <x-nav_link href="/books" :active="request()->is('books')">
                                <i class="fa-solid fa-book mr-1"></i> Books
                            </x-nav_link>
                            <x-nav_link href="/bookmarks" :active="request()->is('bookmarks')">
                                <i class="fa-solid fa-bookmark mr-1"></i>
                                <p>
                                    Book Marks
                                </p>
                            </x-nav_link>
                        </nav>
                    </div>

                    <!-- Right Section -->
                    <div class=" hidden md:flex items-center space-x-2">
                        <div>
                            <a href="/books/create" class="relative text-white text-[14px] hover:bg-white hover:text-blue-600 rounded-lg py-1 px-2">
                                <i class="fa-solid fa-plus text-sm mt-1"></i>
                                Upload book
                            </a>
                        </div>


                        @guest
                        <a href="/login" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-sign-out-alt  mr-1 text-[12px] mt-1"></i>
                            <p class="text-[14px]">Log In</p>
                        </a>
                        <a href="/register" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-user-plus mr-1 text-[12px] mt-1"></i>
                            <p class="text-[14px]"> Register</p>
                        </a>
                        @endguest
                        @auth
                        @if (Auth::user()->role==='admin')
                        <button id="dropdownButton" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center gap-[2px]">
                            <i class="fa-solid fa-user-shield text-[12px] mr-1"></i>
                            <p class="text-[14px]">{{ Auth::user()->name }}</p>
                            <i class="fa-solid fa-chevron-circle-down text-[12px] mt-1"></i>

                        </button>
                        @else
                        <button id="dropdownButton" class="text-white rounded-md px-4 py-1 hover:bg-white hover:text-blue-600 flex items-center justify-center gap-[2px]">
                            <i class="fa-solid fa-user text-[12px] mr-1"></i>
                            <p class="text-[14px]">{{ Auth::user()->name }}</p>
                            <i class="fa-solid fa-chevron-circle-down text-[12px] mt-1"></i>

                        </button>
                        @endif


                        @endauth
                    </div>

                    <!-- Hamburger Button -->
                    <button id="menu-btn" class="block md:hidden text-white text-lg z-50 fixed top-4 right-4">
                        ☰
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="mobile-menu" class="hidden absolute top-12 right-4 z-50 bg-white bg-opacity-80 backdrop-blur-md shadow-lg rounded-lg w-48 p-4">
                        <nav class="space-y-2">
                            <a href="/" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-house flex-shrink-0 w-5"></i> <span>Home</span>
                            </a>
                            <a href="/users" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-tachometer-alt flex-shrink-0 w-5"></i> <span>Dashboard</span>
                            </a>
                            <a href="/books" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-book flex-shrink-0 w-5"></i> <span>Books</span>
                            </a>
                            <a href="/books/create" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-book flex-shrink-0 w-5"></i> <span>Add book</span>
                            </a>

                        </nav>

                        @guest
                        <div class="space-y-2">
                            <a href="/login" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-sign-in-alt flex-shrink-0 w-5"></i> <span>Log In</span>
                            </a>
                            <a href="/register" class="block text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-user-plus flex-shrink-0 w-5"></i> <span>Register</span>
                            </a>
                        </div>
                        @endguest

                        @auth
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-center px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-blue-600 hover:text-white rounded flex items-center space-x-2">
                                <i class="fa-solid fa-sign-out-alt flex-shrink-0 w-5"></i> <span>Log out</span>
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>

            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
        <footer class="bg-white">
            <div class="container mx-auto w-full max-w-7xl px-16 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 justify-center lg:grid-cols-[50%,25%,25%] gap-4 ">
                    <!-- 1 -->
                    <div class="max-w-md text-[14px] p-4">
                        <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                            About Us
                        </h1>
                        <div class="text-[#666] flex flex-col gap-1">
                            <p class="font-heading"> Welcom to the BMA Online Library, an exclusive digital resource for the staff of Bank-e-Mili Afghan (BMA). Our library offers a wide range of free educational digital books, all aimed at supporting the professional and personal development of our team.</p>


                        </div>
                    </div>
                    <!-- 2 -->

                    <div>
                        <div class="mt-4">
                            <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                                User Account
                            </h1>
                        </div>
                        <div class="flex flex-col gap-3 text-[#666] text-sm">
                            <a href="/users" class="group">
                                <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                            </a>

                            <a href="/user/books" class="group">
                                <i class="fa-solid fa-book text-[#666] mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Manage Books</span>
                            </a>
                            @guest

                            <a href="/login" class="group">
                                <i class="fa-solid fa-sign-in-alt text-[#666] mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Login</span>
                            </a>
                            <a href="/register" class="group">
                                <i class="fa-solid fa-user-plus text-[#666] mr-2"></i>
                                <span class="group-hover:border-b group-hover:border-black">Register</span>
                            </a>
                            @endguest
                            @auth

                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="group">
                                    <i class="fa-solid fa-sign-out-alt text-[#666]"></i> <span class="group-hover:border-b group-hover:border-black">Log out</span>
                                </button>
                            </form>
                            @endauth
                        </div>

                    </div>
                    <!-- 3 -->
                    <div>
                        <div class="mt-4">
                            <h1 class="inline-block font-bold text-2xl border-b-2 mb-2 text-gray-800">
                                Follow Us
                            </h1>
                        </div>
                        <div class="text-2xl">
                            <a href="https://www.facebook.com" class="text-blue-600 hover:text-blue-800 transition-transform duration-200" target="_blank">
                                <i class="fab fa-facebook-f text-[#666] transform hover:scale-110"></i>
                            </a>
                            <a href="https://www.twitter.com" class="text-blue-400 hover:text-blue-600 ml-4 transition-transform duration-200" target="_blank">
                                <i class="fab fa-twitter text-[#666] transform hover:scale-110"></i>
                            </a>
                            <a href="https://www.youtube.com" class="text-red-600 hover:text-red-800 ml-4 transition-transform duration-200" target="_blank">
                                <i class="fab fa-youtube text-[#666] transform hover:scale-110"></i>
                            </a>
                            <a href="https://www.instagram.com" class="text-pink-600 hover:text-pink-800 ml-4 transition-transform duration-200" target="_blank">
                                <i class="fab fa-instagram text-[#666] transform hover:scale-110"></i>
                            </a>
                            <a href="https://www.googl.com" class="text-pink-600 hover:text-pink-800 ml-4 transition-transform duration-200" target="_blank">
                                <i class="fab fa-google text-[#666] transform hover:scale-110"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </footer>
    </div>


</body>

</html>
