<x-layout>
    <div class="container w-full max-w-7xl px-8 py-2 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar -->
        <div class="p-4 rounded-lg shadow-lg col-span-1 h-48 bg-white ">
            <div class="flex flex-col gap-3 text-[#666] text-lg">
                <a href="/users" class="group flex items-center" aria-label="Go to Dashboard">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>
                <a href="/user/books" class="group flex items-center" aria-label="Manage Books">
                    <i class="fa-solid fa-book text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
                </a>
                <a href="/users/{{ $user->id }}/profile" class="group flex items-center" aria-label="Edit Profile">
                    <i class="fa-solid fa-user text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
                </a>
                <a href="/bookmarks" class="group flex items-center" aria-label="View Bookmarks">
                    <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-span-2 flex flex-col px-4 ">
            <div class="mb-2">
                <h1 class="text-3xl font-bold">Bookmarks</h1>
                <p class="text-gray-400 text-md italic">Browse through your personal selection of saved books.</p>
            </div>
            @if ($bookmarks->isNotEmpty())
            <div class="grid grid-cols-1 gap-4">
                @foreach ($bookmarks as $bookmark)
                <div class="flex gap-4 p-4 gap-8  rounded-lg shadow-lg bg-white">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 w-32 h-32 ">
                        <a href="/books/{{$bookmark->book->id}}">

                            <img src="{{ asset('storage/' . $bookmark->book->cover_image) }}" alt="{{ $bookmark->book->title }}" class="w-full h-full object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex flex-col justify-between">
                        <h2 class="text-2xl font-bold italic mb-1">{{ $bookmark->book->title }}</h2>
                        <p class="text-md text-gray-500">Author: {{ $bookmark->book->author }}</p>
                        <p class="text-md text-gray-500">Category: {{ $bookmark->book->category->name }}</p>
                        <!-- Action Buttons -->
                        <div class=" mt-3">
                            <form action="/bookmarks/{{ $bookmark->id }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this bookmark?')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect_url" value="/bookmarks">
                                <button type="submit" class="bg-blue-600 py-2 px-6 text-center text-white rounded-lg transition-transform hover:scale-105">
                                    Remove bookmark
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <h2 class="p-4 text-2xl font-semibold text-gray-700 text-center">No bookmarks yet.</h2>
            @endif
        </div>
    </div>
</x-layout>
