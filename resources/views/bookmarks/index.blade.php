<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <div class="p-4 rounded-lg shadow-lg col-span-1 h-48 bg-white">
            <div class="flex flex-col gap-3 text-[#666] text-lg">
                @if (Auth::user()->role =='admin')
                <a href="/admin/dashboard" class="group flex items-center">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>
                @else
                <a href="/users" class="group flex items-center">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>
                @endif

                <a href="/user/books" class="group flex items-center">
                    <i class="fa-solid fa-book text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage Your Books</span>
                </a>
                <a href="{{route('profile.edit')}}" class="group flex items-center">
                    <i class="fa-solid fa-user text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
                </a>
                <a href="/bookmarks" class="group flex items-center">
                    <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-span-2 p-4 rounded-lg shadow-lg bg-white">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bookmarks</h1>
                <p class="text-gray-500 text-md">Browse through your personal selection of saved books.</p>
            </div>

            @if ($bookmarks->isNotEmpty())
            <div>
                @foreach ($bookmarks as $bookmark)
                <div class="flex gap-4 p-2 rounded-lg shadow-md bg-gray-50 hover:shadow-lg transition-shadow duration-300">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 w-32 h-48">
                        <a href="/books/{{ $bookmark->book->id }}">
                            <img src="{{ asset('storage/' . $bookmark->book->cover_image) }}" alt="{{ $bookmark->book->title }}" class="w-full h-[60%] object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex flex-col gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $bookmark->onlineBook->title }}</h2>
                            <p class="text-md text-gray-600 mb-1">Author: {{ $bookmark->onlineBook->author }}</p>
                            <p class="text-md text-gray-600">Category: {{ $bookmark->onlineBook->category->name }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div>
                            <form action="/bookmarks/{{ $bookmark->id }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this bookmark?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect_url" value="/bookmarks">
                                <button type="submit" class="bg-blue-600 py-2 px-6 text-center text-white rounded-lg hover:bg-blue-700 transition duration-300">
                                    Remove Bookmark
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-6 text-center">
                <h2 class="text-2xl font-semibold text-gray-700">No bookmarks yet.</h2>
                <p class="text-gray-500 mt-2">Start bookmarking your favorite books to see them here!</p>
            </div>
            @endif
        </div>
    </div>
</x-layout>

