<x-layout>
    <!-- session -->
    <x-session />
    <!-- <x-slot name='heading'>Books</x-slot> -->
    <div class="container mx-auto w-full max-w-7xl shadow-lg p-8 ">
        <div class="w-full max-w-6xl py-4 px-12  grid sm:grid-cols-1 md:grid-cols-[65%,35%] justify-center gap-8">
            <div class="bg-white shadow-lg grid sm:grid-cols-1 md:grid-cols-[25%,70%] gap-5 rounded-lg p-4">
                <div class="p-2 w-full flex flex-col items-center gap-4">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-36 h-48">

                    <form action="{{ $bookmark ? route('user.bookmarks.destroy', $book->id) : route('user.bookmarks.store', $book->id) }}" method="POST">
                        @csrf
                        @if ($bookmark)
                        @method('DELETE')
                        @endif
                        <input type="hidden" name="online_book_id" value="{{ $book->id }}">
                        <input type="hidden" name="redirect_url" value="/books/{{ $book->id }}">
                        <button type="submit" class="text-blue-500 text-lg hover:bg-blue-500 hover:text-white font-semibold px-4 py-1 border border-blue-500 rounded-lg transition duration-300 ease-in-out">
                            <i class="{{ $bookmark ? 'fas' : 'far' }} fa-bookmark"></i> {{ $bookmark ? 'Bookmarked' : 'Bookmark' }}
                        </button>
                    </form>

                </div>
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
                        <p>release: </p>
                        <p>{{ $book->release_date }}</p>
                        <p>Edition :</p>
                        @if ($book->edition == 0 || $book->edition ==1)
                        <p> 1 <sup>st</sup></p>
                        @elseif ($book->edition == 2)
                        <p> 2 <sup>nd</sup></p>
                        @elseif ($book->edition == 3)
                        <p> 3 <sup>rd</sup></p>
                        @elseif ($book->edition == 4)
                        <p> 4 <sup>th</sup></p>
                        @elseif ($book->edition == 5)
                        <p> 5 <sup>th</sup></p>

                        @endif
                        <p>File type:</p>
                        <p>PDF</p>
                        <p>File size:</p>
                        <p>
                            @if($book->file_size < 1024)
                                {{ $book->file_size }} bytes
                                @elseif($book->file_size < 1048576)
                                    {{ round($book->file_size / 1024, 2) }} KB
                                    @else
                                    {{ round($book->file_size / 1048576, 2) }} MB
                                    @endif
                                    </p>
                                    <p>Downloads:</p>
                                    <p>{{ $book->downloads }}</p>
                    </div>
                    <div class="flex justify-start gap-6 mt-4">
                        <a href="{{ route('user.book.download', ['id' => $book->id]) }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-lg font-semibold px-5 py-2 rounded-lg shadow-lg flex items-center gap-2 transition duration-300 ease-in-out">
                            <i class="fas fa-download"></i> Download
                        </a>
                        <a href="{{ route('user.book.read', ['id' => $book->id]) }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-lg font-semibold px-5 py-2 rounded-lg shadow-lg flex items-center gap-2 transition duration-300 ease-in-out">
                            <i class="fas fa-book-open"></i> Read
                        </a>
                    </div>


                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4">
                <h3 class="text-xl font-bold">Related Books</h3>
                <ul class="flex overflow-x-auto space-x-4 p-4">
                    @foreach($relatedBooks as $relatedBook)
                    <li class="min-w-[120px]">
                        <div class="p-2 rounded-lg shadow-md bg-gray-100 hover:bg-gray-200 transition duration-300">
                            <a href="{{ route('books.show', $relatedBook->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                                <img src="{{ asset('storage/' . $relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="w-28 h-32 bg-center rounded-lg shadow-md">
                                <p class="text-sm mt-1 text-center">{{ Str::limit($relatedBook->title, 15) }}</p>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>


    </div>


</x-layout>
