<x-layout>
    <!-- Searching Component -->
    <x-search :categories="$categories" />

    <div class="container grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 w-full max-w-7xl mx-auto p-4">
        @if ($books->isEmpty())
        <div class="w-full col-span-3 bg-white rounded-lg shadow-lg p-6 text-center">
            <h1 class="text-lg font-bold text-red-500">No books found!</h1>
        </div>
        @else
        @foreach ($books as $book)
        <div class="w-full max-w-[200px] bg-white p-2 rounded-lg shadow-md flex flex-col items-center">
            <!-- Book Image -->
            <a href="{{ route('books.show', $book->id) }}" class="w-full">
                <img
                    src="{{ asset('storage/' . $book->cover_image) }}"
                    alt="{{ $book->title }}"
                    class="w-full h-[120px] object-cover rounded-md" />
            </a>

            <!-- Book Details -->
            <div class="w-full flex flex-col items-center text-center mt-2">
                <h3 class="text-sm font-bold text-gray-800 truncate w-full">{{ Str::limit($book->title, 12) }}</h3>
                <p class="text-xs font-semibold text-gray-500">{{ $book->author }}</p>
                <p class="text-xs text-gray-600">{{ $book->language }}</p>
                <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                    {{ $book->category->name }}
                </p>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</x-layout>
