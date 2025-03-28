<x-layout>
    <div class="container w-full max-w-7xl grid grid-cols-1 md:grid-cols-[20%,80%] md:gap-12 gap-4">
        @auth
        @if (Auth::user()->role == 'admin')
        <x-admin-sidebar :user="Auth::user()" />

        @elseif (Auth::user()->role == 'user')
        <x-user-sidebar :user="Auth::user()" />

        @endif
        @endauth


        <!-- Main Content Area -->
        <div class=" p-4 rounded-lg shadow-lg bg-white">

            @if ($bookmarks->isNotEmpty())
            <div class="grid grid-cols-1 gap-4">
                @foreach ($bookmarks as $bookmark)
                <div class="flex gap-4 p-4 rounded-lg shadow-md bg-gradient-to-r from-gray-50 to-gray-100 hover:shadow-lg transition-shadow  border border-gray-200">
                    <!-- Book Cover -->
                    <div class="flex-shrink-0 w-24 h-36">
                        <a href="{{ route('books.show',$bookmark->online_book_id) }}">
                            <img src="{{ asset('storage/' . $bookmark->book->cover_image) }}" alt="{{ $bookmark->book->title }}" class="w-full h-full object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex flex-col gap-2">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800
                            mb-1">{{ $bookmark->book->title }}</h2>
                            <p class="text-sm text-gray-600 mb-1">Author: {{ $bookmark->book->author }}</p>
                            <p class="text-sm text-gray-600">Category: {{ $bookmark->book->category->name }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div>
                            <form action="{{ route('user.bookmarks.destroy',$bookmark->online_book_id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                <input type="hidden" name="online_book_id" value="{{ $bookmark->online_book_id }}">
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
            <div class="p-2 text-center">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 mt-2">
                    <i class="fas fa-bookmark mr-2"></i> Find Books to Bookmark
                </a>
            </div>

        </div>
    </div>
</x-layout>
