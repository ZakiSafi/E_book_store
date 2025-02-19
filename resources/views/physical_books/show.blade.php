<x-layout>
    <!-- session -->
    <x-session />
    <div class="container mx-auto w-full max-w-7xl shadow-lg p-8">
        <div class="w-full max-w-6xl py-4 px-12 grid sm:grid-cols-1 md:grid-cols-[60%,40%] justify-center gap-8">
            <!-- Book Details Section -->
            <div class="bg-white shadow-lg grid sm:grid-cols-1 md:grid-cols-[25%,70%] gap-5 rounded-lg p-4">
                <!-- Book Cover Image -->
                <div class="p-2 w-full flex flex-col items-center gap-4">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-36 h-48  rounded-lg shadow-md">
                </div>

                <!-- Book Information -->
                <div class="flex flex-col gap-4 p-2">
                    <div>
                        <h2 class="text-3xl font-bold italic mb-1">{{ $book->title }}</h2>
                        <p class="text-lg text-gray-500">{{ $book->author }}</p>
                    </div>


                    <p class="text-md text-gray-600">{{ $book->description }}</p>

                    <div class="grid grid-cols-[150px_auto] gap-y-2 gap-x-4 text-md">
                        <p class="font-semibold text-gray-700">Translator:</p>
                        <p class="text-gray-600">{{ $book->translator ?? 'N/A' }}</p>

                        <p class="font-semibold text-gray-700">Category:</p>
                        <p class="text-gray-600">{{ $book->category->name }}</p>

                        <p class="font-semibold text-gray-700">Language:</p>
                        <p class="text-gray-600">{{ $book->language }}</p>

                        <p class="font-semibold text-gray-700">Edition:</p>
                        <p class="text-gray-600">{{ ordinal($book->edition) }}</p>

                        <p class="font-semibold text-gray-700">Publish Year:</p>
                        <p class="text-gray-600">{{ $book->publication_year }}</p>

                        <p class="font-semibold text-gray-700">Publisher:</p>
                        <p class="text-gray-600">{{ $book->printing_house }}</p>

                        <p class="font-semibold text-gray-700">Shelf No:</p>
                        <p class="text-gray-600">{{ $book->shelf_no }}</p>


                    </div>
                </div>
            </div>

            <!-- Related Books Section -->
            <div class="bg-white rounded-lg shadow-lg p-4 ">
                <h3 class="text-xl font-bold">Related Books</h3>
                <ul class="flex overflow-x-auto space-x-4 p-4">
                    @foreach($relatedBooks as $relatedBook)
                    <li class="min-w-[120px]">
                        <div class="p-2 rounded-lg shadow-md bg-gray-100 hover:bg-gray-200 transition duration-300">
                            <a href="{{ route('physicalBooks.show', $relatedBook->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                                <img src="{{ asset('storage/' . $relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="w-28 h-32 bg-center rounded-lg shadow-md">
                                <p class="text-sm mt-1 text-center truncate">{{ Str::limit($relatedBook->title, 25) }}</p>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>