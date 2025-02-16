<x-layout>
    <!-- Searching Component -->
    <x-search :categories="$categories" />

    <div class="container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-full max-w-7xl mx-auto p-4">
        @if ($books->isEmpty())
        <div class="w-full col-span-3 bg-white rounded-lg shadow-lg p-6 text-center">
            <h1 class="text-lg font-bold text-red-500">No books found!</h1>
        </div>
        @else
        @foreach ($books as $book)
        <div class="w-full h-[300px] bg-white p-3 rounded-lg shadow-md flex flex-col items-center">
            <!-- Book Image -->
            <a href="{{ route('books.show', $book->id) }}" class="w-full">
                <img
                    src="{{ asset('storage/' . $book->cover_image) }}"
                    alt="{{ $book->title }}"
                    class="w-full h-[150px] object-cover rounded-md" />
            </a>

            <!-- Book Details -->
            <div class="w-full flex flex-col items-center text-center mt-2">
                <h3 class="text-md font-bold text-gray-800 truncate w-full">{{ Str::limit($book->title, 12) }}</h3>
                <p class="text-sm font-semibold text-gray-500">{{ $book->author }}</p>
                <p class="text-sm text-gray-600">{{ $book->language }}</p>
                <p class="text-xs font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                    {{ $book->category->name }}
                </p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</x-layout>
