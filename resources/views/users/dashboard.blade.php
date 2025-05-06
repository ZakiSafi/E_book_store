<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-user-sidebar :user="Auth::user()" />

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-8">
            <!-- Quick Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-book text-3xl text-blue-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Books Uploaded</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{ $user->Onlinebooks->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-bookmark text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Bookmarks</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{ $user->bookmarks->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-clock text-3xl text-purple-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Last Upload</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">
                            @if ($lastUploadedBook)
                            {{$lastUploadedBook->created_at->diffForHumans()}}
                            @else
                            No books uploaded yet
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- User Activity -->

            <div class="space-y-8">
                <!-- Uploaded Books Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Your Uploaded Books</h3>
                        <a href="{{ route('user.books') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                    </div>
                    @if($uploadedBooks->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($uploadedBooks as $book)
                        <div class="w-full max-w-[200px] flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                            <a href="{{ route('books.show', $book->id) }}" class="w-full">
                                <div class="w-full flex flex-col items-center text-center mt-2">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                                    <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($book->title, 20) }}</h3>
                                    <p class="text-xs font-semibold text-gray-500">{{ $book->author }}</p>
                                    <p class="text-xs text-gray-600">{{ $book->language }}</p>

                                    {{-- Status Tag --}}
                                    <span class="text-[10px] font-semibold px-2 py-1 rounded-full
    {{ $book->status === 'approved' ? 'bg-green-100 text-green-600' :
       ($book->status === 'rejected' ? 'bg-red-100 text-red-600' :
       'bg-yellow-100 text-yellow-600') }}">
                                        {{ ucfirst($book->status) }}
                                    </span>


                                    {{-- Category Tag --}}
                                    <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                                        {{ $book->category->name }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">You haven't uploaded any books yet</p>
                        <a href="{{ route('user.books.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Upload Your First Book
                        </a>
                    </div>
                    @endif

                </div>

                <!-- Borrowed Books Section -->
                <div class="bg-white rounded-lg shadow-md p-6">

                    @if($borrowedBooks->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($borrowedBooks as $borrow)
                        <div class="w-full max-w-[200px]  flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                            <a href="{{ route('books.show', $borrow->book->id) }}" class="w-full">
                                <div class="w-full flex flex-col  items-center text-center mt-2">
                                    <img src="{{ asset('storage/' . $borrow->book->cover_image) }}" alt="{{ $borrow->book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                                    <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($borrow->book->title, 20) }}</h3>
                                    <p class="text-xs font-semibold text-gray-500">{{ $borrow->book->author }}</p>
                                    <p class="text-xs text-gray-600">{{ $borrow->book->language }}</p>
                                    <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                                        {{ $borrow->book->category->name }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">You don't have any borrowed books</p>
                        <a href="{{ route('physicalBooks.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-book-open mr-2"></i> Browse Library
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Bookmarked Books Section -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Your Bookmarks</h3>
                        <a href="{{ route('user.bookmarks.index') }}" class="text-sm text-blue-600 hover:underline">View All</a>
                    </div>
                    @if($bookmarkedBooks->isNotEmpty())
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($bookmarkedBooks as $bookmark)
                        <div class="w-full max-w-[200px]  flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                            <a href="{{ route('books.show', $bookmark->book->id) }}" class="w-full">
                                <div class="w-full flex flex-col  items-center text-center mt-2">
                                    <img src="{{ asset('storage/' . $bookmark->book->cover_image) }}" alt="{{ $bookmark->book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                                    <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($bookmark->book->title, 20) }}</h3>
                                    <p class="text-xs font-semibold text-gray-500">{{ $bookmark->book->author }}</p>
                                    <p class="text-xs text-gray-600">{{ $bookmark->book->language }}</p>
                                    <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                                        {{ $bookmark->book->category->name }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">You haven't bookmarked any books yet</p>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-bookmark mr-2"></i> Find Books to Bookmark
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="{{route('user.books.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fa-solid fa-plus mr-2"></i> Upload Book
                    </a>
                    <a href="{{route('user.bookmarks.index')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fa-solid fa-bookmark mr-2"></i> View Bookmarks
                    </a>
                    <a href="{{route('user.books')}}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        <i class="fa-solid fa-book mr-2"></i> Manage Your Books
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-layout>
