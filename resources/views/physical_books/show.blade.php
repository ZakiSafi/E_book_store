<x-layout>
    <!-- session -->
    <x-session />
    <div class="container mx-auto w-full max-w-7xl shadow-lg p-8">
        <div class="w-full max-w-6xl py-4 px-12 grid sm:grid-cols-1 md:grid-cols-[60%,40%] justify-center gap-8">
            <!-- Book Details Section -->
            <div class="bg-white shadow-lg grid sm:grid-cols-1 md:grid-cols-[25%,70%] gap-5 rounded-lg p-4">
                <!-- Book Cover Image -->
                <div class="p-2 w-full flex flex-col items-center gap-4">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-36 h-48">
                </div>

                <!-- Book Information -->
                <div class="flex flex-col gap-4 p-2">
                    <div>
                        <h2 class="text-2xl font-bold font-italic mb-1">{{ $book->title }}</h2>
                        <p class="text-md text-gray-400">{{ $book->author }}</p>
                    </div>
                    <p class="text-md text-gray-400">{{ $book->description }}</p>
                    <div class="grid grid-cols-[80px_auto] gap-x-8 text-md font-semibold">
                        <p>Category:</p>
                        <p>{{ $book->category->name }}</p>
                        <p>Language:</p>
                        <p>{{ $book->language }}</p>
                        <p>Release:</p>
                        <p>{{ $book->release_date }}</p>
                        <p>Edition:</p>
                        @if ($book->edition == 0 || $book->edition == 1)
                        <p>1<sup>st</sup></p>
                        @elseif ($book->edition == 2)
                        <p>2<sup>nd</sup></p>
                        @elseif ($book->edition == 3)
                        <p>3<sup>rd</sup></p>
                        @elseif ($book->edition == 4)
                        <p>4<sup>th</sup></p>
                        @elseif ($book->edition == 5)
                        <p>5<sup>th</sup></p>
                        @endif
                        <p>Publish_Year:</p>
                        <p>{{ $book->publication_year }}</p>
                        <p>Pages:</p>
                        <p>{{ $book->pages }}</p>
                        <p>Publisher:</p>
                        <p>{{ $book->publisher }}</p>
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
                                <p class="text-sm mt-1 text-center">{{ Str::limit($relatedBook->title, 25) }}</p>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>
