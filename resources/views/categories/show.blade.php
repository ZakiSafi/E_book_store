<x-layout>

    <x-search :categories='$categories' />

    <div class="flex items-center justify-center mt-8 mb-4">
        <h1 class="text-4xl font-extrabold  bg-gradient-to-r from-blue-400 to-blue-500 text-transparent bg-clip-text">
            {{ $category->name }} Books
        </h1>
    </div>
    <div class="min-h-[50vh] bg-gray-100">
        <div class="container w-full max-w-7xl mx-auto px-12 py-6">
            <h1 class="text-2xl text-gray-800 font-bold ">Digital Books</h1>
            <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 items-center justify-center p-8">
                @if ($category->onlineBooks && !$category->onlineBooks->isEmpty())
                @foreach ($category->onlineBooks as $book)
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
                <div class="w-full col-span-4 bg-white rounded-lg shadow-lg p-8 text-center">
                    <h1 class="text-lg font-bold text-red-500">No Digital books found!</h1>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="min-h-[50vh] flex items-center justify-center bg-gray-100">
        <div class="container w-full max-w-7xl mx-auto px-12 py-6">
            <h1 class="text-2xl text-gray-800 font-bold">physical Books</h1>
            <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
                @if ($category->physicalBooks && !$category->physicalBooks->isEmpty())
                @foreach ($category->physicalBooks as $book)
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
    </div>
    <!-- physical books -->




</x-layout>
