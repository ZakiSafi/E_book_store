<!-- resources/views/components/user-sidebar.blade.php -->
@props(['user'])
@php
$user = auth()->user();
$lastLoginDate = $user->last_login_at
? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans()
: 'Now';
@endphp
<aside
    class=' hidden md:block w-64  bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg'>
    <nav class="p-4">
        <div class="flex items-center space-x-4 p-4 bg-blue-800 rounded-lg shadow-lg">
            <div class="relative">
                <!-- Profile Picture -->
                <img
                    src="{{ asset('storage/'.$user->profile_picture) }}"
                    alt="profile picture"
                    class="h-16 w-16 rounded-full border-2 border-white shadow-lg transition-transform transform hover:scale-105 duration-300">

            </div>
            <div>
                <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                <p class="text-[10px] text-blue-200 truncate">{{ $user->email }}</p>
                <p class="text-[10px] text-blue-200">

                    Last Login:
                    {{ $lastLoginDate }}
                </p>
            </div>
        </div>
        <ul class="space-y-1 mt-4">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('user.dashboard') }}" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>

            <!-- Manage Books -->
            <li>
                <a href="{{ route('user.books') }}" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-book mr-3"></i> Manage Your Books
                </a>
            </li>

            <!-- Edit Profile -->
            <li>
                <a href="{{ route('user.profile.edit') }}" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-user mr-3"></i> Edit Profile
                </a>
            </li>

            <!-- Bookmarks -->
            <li>
                <a href="{{ route('user.bookmarks.index') }}" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-bookmark mr-3"></i> Bookmarks
                </a>
            </li>
        </ul>
    </nav>
</aside>
