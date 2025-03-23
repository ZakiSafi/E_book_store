<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-user-sidebar :user="Auth::user()" />

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-8">
            <!-- User Greeting Section -->
            <div class="flex gap-4 mb-8">
                <div>
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-24 w-24">
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-book text-3xl text-blue-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Books Uploaded</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{ $user->Onlinebooks->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-bookmark text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Bookmarks</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{ $user->bookmarks->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-clock text-3xl text-purple-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Last Upload</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">
                            @if ($lastUploadedBook)
                            {{$lastUploadedBook->created_at->diffForHumans()}}
                            @else
                            No books uploaded yet
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mb-8">
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
        </main>
    </div>
</x-layout>
