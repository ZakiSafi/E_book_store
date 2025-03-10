<x-layout>

    <!-- main content -->
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <x-sideBar />

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-2">
            <h2 class="text-2xl font-bold mb-4 border-b-2">Dashboard</h2>

            <!-- User Greeting Section -->
            <div class="flex gap-4">
                <div>
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-24 w-24 cursor-pointer">
                    @else
                    <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Default Profile Picture" class="rounded-full h-24 w-24">
                    @endif
                </div>
                <div>
                    <p class="text-gray-700"><span class="inline-block text-md font-semibold">Hello</span>, {{ $user->name }}</p>
                    <p class="text-gray-700">Welcome to your dashboard</p>
                    <p class="text-gray-500">
                        Last Login:
                        @if ($lastLoginDate)
                        {{ $lastLoginDate->diffForHumans() }}
                        @else
                        Now
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Books Uploaded</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $user->Onlinebooks->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Bookmarks</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $user->bookmarks->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Last Upload</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        @if ($lastUploadedBook)
                        {{$lastUploadedBook->created_at->diffForHumans()}}
                        @else
                        No books uploaded yet
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="{{route('user.books.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fa-solid fa-plus mr-2"></i> Upload Book
                    </a>
                    <a href="{{route('user.bookmarks.index')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fa-solid fa-bookmark mr-2"></i> View Bookmarks
                    </a>

                    <a href="{{route('user.books')}}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        <i class="fa-solid fa-book mr-2"></i> Manage Your Books
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-profile-popup>
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
        <h2 class="text-2xl">{{ $user->name }}</h2>
        <p class="mt-2">{{ $user->email }}</p>
    </x-profile-popup>
</x-layout>
