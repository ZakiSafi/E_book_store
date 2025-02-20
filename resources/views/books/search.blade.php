<x-layout>
    <!-- Searching Component -->
    <x-search :categories="$categories" />

    <div class="container w-full max-w-7xl mx-auto p-8">
        <h1 class="text-[24px] text-gray-500">Result for Digital Books</h1>
        <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
            @if ($onlineBooks && !$onlineBooks->isEmpty())
            @foreach ($onlineBooks as $book)
            <div class="w-full max-w-[200px]  flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                <a href="{{ route('books.show', $book->id) }}" class="w-full">
                    <div class="w-full flex flex-col  items-center text-center mt-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                        <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($book->title, 20) }}</h3>
                        <p class="text-xs font-semibold text-gray-500">{{ $book->author }}</p>
                        <p class="text-xs text-gray-600">{{ $book->language }}</p>
                        <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                            {{ $book->category->name }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="w-full col-span-4 bg-white rounded-lg shadow-lg p-6 text-center">
                <h1 class="text-lg font-bold text-red-500">No Digital books found!</h1>
            </div>
            @endif
        </div>
    </div>

    <!-- showing results for physical books -->
    <div class="container w-full max-w-7xl mx-auto p-8">
        <h1 class="text-[24px] text-gray-500">Result for Physical Books</h1>
        <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
            @if ($physicalBooks && !$physicalBooks->isEmpty())
            @foreach ($physicalBooks as $book)
            <div class="w-full max-w-[200px]  flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                <a href="{{ route('physicalBooks.show', $book->id) }}" class="w-full">
                    <div class="w-full flex flex-col  items-center text-center mt-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                        <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($book->title, 20) }}</h3>
                        <p class="text-xs font-semibold text-gray-500">{{ $book->author }}</p>
                        <p class="text-xs text-gray-600">{{ $book->language }}</p>
                        <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                            {{ $book->category->name }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <div class="w-full col-span-4 bg-white rounded-lg shadow-lg p-6 text-center">
                <h1 class="text-lg font-bold text-red-500">No physical books found!</h1>
            </div>
            @endif
        </div>
    </div>
</x-layout>
