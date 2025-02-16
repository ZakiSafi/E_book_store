<x-layout>
    <!-- searching component -->
    <x-search :categories="$categories" />
    <div class="container grid grid-cols-3 items-center justify-center w-full max-w-7xl mx-auto  pt-2 pb-8">
        <div class="w-full  mx-auto bg-white rounded-lg shadow-lg mb-2 p-2 col-span-3">
            <h1 class="font-semibold text-2xl text-center ">Search result for "{{ $searchQuery }}"</h1>
        </div>
        @if ($books->isEmpty())
        <div class="w-full col-span-3 mx-auto bg-white rounded-lg shadow-lg p-2 mb-2">
            <h1 class="pb-2 font-bold text-xl text-red-500  ">No books found!</h1>
        </div>
        @else
        @foreach ($books as $book)
        <div class="w-full bg-white p-4 rounded-lg shadow-lg">
            <div class="flex gap-4 items-center p-4">
                <div class="rounded-lg overflow-hidden rounded-lg">
                    <a href="/books/{{$book->id}}">

                        <img
                            src="{{ asset('storage/' . $book->cover_image) }}"
                            alt="{{ $book->title }}"
                            class="object-cover w-64 h-48 rounded-lg " />
                    </a>
                </div>
                <div class="self-start flex flex-col gap-2">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-md font-semi-bold text-gray-400">{{ $book->author }}</p>
                    <p class="text-md font-semibold text-gray-600">{{ $book->language }}</p>
                    <p class="text-md font-semibold text-gray-600">{{ $book->category->name }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</x-layout>
