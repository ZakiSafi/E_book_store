<x-layout>
    <x-session />
    <div class="container mx-auto w-full max-w-7xl pr-4 sm:pr-6 lg:pr-8">
        <!-- Conditional grid layout -->
        <div class="w-full grid @auth grid-cols-1 md:grid-cols-[18%,82%] @else grid-cols-1 @endauth gap-4 md:gap-16">
            <!-- Sidebar (only shown when logged in) -->
            @auth

                @if (Auth::user()->role == 'admin')
                <x-admin-sidebar :user="Auth::user()" />
                @elseif (Auth::user()->role == 'user')
                <x-user-sidebar :user="Auth::user()" />
                @endif

            @endauth

            <!-- Main Content (takes full width when not logged in) -->
            <div class="w-full @auth @else md:col-span-full @endauth">
                <!-- Book Card -->
                <div class="bg-white shadow-lg flex flex-col md:flex-row gap-4 md:gap-8 rounded-lg p-4 md:p-6">
                    <!-- Book Cover -->
                    <div class="w-full md:w-1/4 flex flex-col items-center gap-4">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="w-24 h-32 sm:w-32 sm:h-40 md:w-36 md:h-48 rounded-lg shadow-md object-cover">

                        <form action="{{ $bookmark ? route('user.bookmarks.destroy', $book->id) : route('user.bookmarks.store', $book->id) }}" method="POST">
                            @csrf
                            @if ($bookmark)
                            @method('DELETE')
                            @endif
                            <input type="hidden" name="online_book_id" value="{{ $book->id }}">
                            <input type="hidden" name="redirect_url" value="/books/{{ $book->id }}">
                            <button type="submit" class="text-blue-500 text-sm sm:text-base hover:bg-blue-500 hover:text-white font-semibold px-2 py-1 border border-blue-500 rounded-lg transition duration-300 ease-in-out">
                                <span>{{ $bookmark ? 'Bookmarked' : 'Bookmark' }}<i class="{{ $bookmark ? 'fas' : 'far' }} fa-bookmark ml-1"></i></span>
                            </button>
                        </form>
                    </div>

                    <!-- Book Details -->
                    <div class="w-full md:w-3/4 flex flex-col gap-3 md:gap-4">
                        <div>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold italic mb-1">{{ $book->title }}</h2>
                            <p class="text-sm sm:text-base md:text-lg text-gray-500">{{ $book->author }}</p>
                        </div>

                        <p class="text-sm sm:text-base text-gray-600">{{ $book->description }}</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-4 text-sm sm:text-base">
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">Category:</p>
                                <p class="text-gray-600">{{ $book->category->name }}</p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">Language:</p>
                                <p class="text-gray-600">{{ $book->language }}</p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">Edition:</p>
                                <p class="text-gray-600">{{ ordinal($book->edition) }}</p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">Publish Year:</p>
                                <p class="text-gray-600">{{ $book->release_date }}</p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">File Type:</p>
                                <p class="text-gray-600">{{ $book->file_type }}</p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">File size:</p>
                                <p class="text-gray-600">
                                    @if($book->file_size < 1024)
                                        {{ $book->file_size }} bytes
                                        @elseif($book->file_size < 1048576)
                                            {{ round($book->file_size / 1024, 2) }} KB
                                            @else
                                            {{ round($book->file_size / 1048576, 2) }} MB
                                            @endif
                                            </p>
                            </div>
                            <div class="flex">
                                <p class="font-semibold text-gray-700 w-28">Downloads:</p>
                                <p class="text-gray-600">{{ $book->downloads }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-start gap-3 mt-3 md:mt-4">
                            <a href="{{ route('user.book.download', ['id' => $book->id]) }}"
                                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm sm:text-base font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center justify-center gap-2 transition duration-300 ease-in-out">
                                <i class="fas fa-download"></i> Download
                            </a>
                            <a href="{{ route('user.book.read', ['id' => $book->id]) }}"
                                class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm sm:text-base font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center justify-center gap-2 transition duration-300 ease-in-out">
                                <i class="fas fa-book-open"></i> Read
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Books -->
                <div class="bg-white rounded-lg shadow-lg p-4 md:p-6 mt-4 md:mt-6">
                    <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Related Books</h3>
                    <div class="overflow-x-auto">
                        <ul class="flex space-x-3 md:space-x-4 pb-2">
                            @foreach($relatedBooks as $relatedBook)
                            <li class="min-w-[120px] sm:min-w-[140px]">
                                <div class="p-2 rounded-lg shadow-md bg-gray-100 hover:bg-gray-200 transition duration-300 h-full">
                                    <a href="{{ route('books.show', $relatedBook->id) }}" class="text-sm sm:text-base font-semibold text-blue-600 hover:underline flex flex-col items-center">
                                        <img src="{{ asset('storage/' . $relatedBook->cover_image) }}"
                                            alt="{{ $relatedBook->title }}"
                                            class="w-20 h-24 sm:w-24 sm:h-32 md:w-28 md:h-36 rounded-lg shadow-md object-cover">
                                        <p class="text-xs sm:text-sm mt-2 text-center truncate w-full">{{ Str::limit($relatedBook->title, 15) }}</p>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
