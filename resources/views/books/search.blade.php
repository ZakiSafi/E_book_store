<x-layout>
    <!-- Searching Component -->
    <x-search :categories="$categories" />

    <!-- Digital Books Results -->
    <div class="container w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-xl sm:text-2xl font-medium text-gray-600 mb-4">Results for Digital Books</h1>
        <div class="w-full mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 justify-center">
            @if ($onlineBooks && !$onlineBooks->isEmpty())
            @foreach ($onlineBooks as $book)
            <div class="w-full flex flex-col items-center transform transition-transform duration-300 hover:scale-105">
                <a href="{{ route('books.show', $book->id) }}" class="w-full">
                    <div class="w-full flex flex-col items-center text-center p-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="w-full h-36 sm:h-40 md:h-48 object-cover rounded-lg mb-2 shadow-md">

                        <h3 class="text-xs sm:text-sm font-bold text-gray-800 w-full truncate px-1">{{ Str::limit($book->title, 25) }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
                        <p class="text-[10px] sm:text-xs text-gray-400">{{ ucfirst($book->language) }}</p>
                        <p class="text-[10px] sm:text-xs font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-2">
                            {{ $book->category->name }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="w-full col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-5 bg-white rounded-lg shadow p-4 sm:p-6 text-center">
                <h1 class="text-base sm:text-lg font-medium text-gray-500">No digital books found</h1>
                <p class="text-sm text-gray-400 mt-2">Try different search terms or categories</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Physical Books Results -->
    <div class="container w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-xl sm:text-2xl font-medium text-gray-600 mb-4">Results for Physical Books</h1>
        <div class="w-full mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6 justify-center">
            @if ($physicalBooks && !$physicalBooks->isEmpty())
            @foreach ($physicalBooks as $book)
            <div class="w-full flex flex-col items-center transform transition-transform duration-300 hover:scale-105">
                <a href="{{ route('physicalBooks.show', $book->id) }}" class="w-full">
                    <div class="w-full flex flex-col items-center text-center p-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                            class="w-full h-36 sm:h-40 md:h-48 object-cover rounded-lg mb-2 shadow-md">

                        <h3 class="text-xs sm:text-sm font-bold text-gray-800 w-full truncate px-1">{{ Str::limit($book->title, 25) }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
                        <p class="text-[10px] sm:text-xs text-gray-400">{{ ucfirst($book->language) }}</p>
                        <p class="text-[10px] sm:text-xs font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-2">
                            {{ $book->category->name }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="w-full col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-5 bg-white rounded-lg shadow p-4 sm:p-6 text-center">
                <h1 class="text-base sm:text-lg font-medium text-gray-500">No physical books found</h1>
                <p class="text-sm text-gray-400 mt-2">Try different search terms or categories</p>
            </div>
            @endif
        </div>
    </div>
</x-layout>
