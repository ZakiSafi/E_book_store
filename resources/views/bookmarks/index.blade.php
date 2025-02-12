<x-layout>
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
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
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Bookmarks</h1>
                <p class="text-gray-500 text-sm italic">Browse through your personal selection of saved books.</p>
            </div>

            @if ($bookmarks->isNotEmpty())
            <div class="grid grid-cols-1 gap-4">
                @foreach ($bookmarks as $bookmark)
                <div class="flex gap-4 p-4 rounded-lg shadow-md bg-gradient-to-r from-gray-50 to-gray-100 hover:shadow-lg transition-shadow duration-300 transform hover:scale-105 border border-gray-200">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 w-24 h-36">
                        <a href="/books/{{ $bookmark->book->id }}">
                            <img src="{{ asset('storage/' . $bookmark->book->cover_image) }}" alt="{{ $bookmark->book->title }}" class="w-full h-full object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex flex-col gap-2">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $bookmark->book->title }}</h2>
                            <p class="text-sm text-gray-600 mb-1">Author: {{ $bookmark->book->author }}</p>
                            <p class="text-sm text-gray-600">Category: {{ $bookmark->book->category->name }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div>
                            <form action="/bookmarks/{{ $bookmark->id }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this bookmark?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect_url" value="/bookmarks">
                                <button type="submit" class="bg-red-600 py-1 px-4 text-center text-white rounded-lg hover:bg-red-700 transition duration-300">
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
                <h2 class="text-xl font-semibold text-gray-700">No bookmarks yet.</h2>
                <p class="text-gray-500 mt-2">Start bookmarking your favorite books to see them here!</p>
            </div>
            @endif
        </div>
    </div>
</x-layout>