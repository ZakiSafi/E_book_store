<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-2 gap-4 mt-8">

        <!-- session success message -->
        <x-session />

        <!-- User Books Section -->
        @if ($books->isNotEmpty())
        <div class="col-span-2">
            <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2 mb-6">User Books</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($books as $book)
                <div class="shadow-md p-4 bg-white rounded-lg">
                    <div class="rounded-lg">
                        <div class="flex gap-8 p-4 items-center rounded-lg">
                            <!-- Book Cover -->
                            <div>
                                <a href="{{ route('books.show', $book->id) }}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-32 h-32 object-cover rounded-lg">
                                </a>
                            </div>

                            <!-- Book Details -->
                            <div class="flex flex-col">
                                <h2 class="text-2xl font-bold italic mb-1">{{ $book->title }}</h2>
                                <hr>
                                <p class="text-md text-gray-500">Author: {{ $book->author }}</p>
                                <hr>
                                <p class="text-md text-gray-500">Category: {{ $book->category->name }}</p>
                                <hr>

                                <!-- File Size -->
                                <p class="text-md text-gray-500">
                                    File Size:
                                    @if ($book->file_size < 1024)
                                        {{ $book->file_size }} bytes
                                        @elseif ($book->file_size < 1048576)
                                            {{ round($book->file_size / 1024, 2) }} KB
                                            @else
                                            {{ round($book->file_size / 1048576, 2) }} MB
                                            @endif
                                            </p>
                                            <hr>

                                            <!-- Action Buttons -->
                                            <div class="flex gap-2 mt-3">
                                                <a href="{{ route('user.books.edit', $book->id) }}" class="bg-blue-600 py-2 px-4 text-white rounded-lg transition-transform hover:scale-105">
                                                    Edit
                                                </a>
                                                <form action="{{ route('user.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 py-2 px-4 text-white rounded-lg transition-transform hover:scale-105">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-gray-500 text-3xl text-center m-auto col-span-2">No books added yet.</p>
        @endif

        <!-- Borrowed Books Section -->
        @if ($borrowedBooks->isNotEmpty())
        <div class="col-span-2">
            <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2 mb-6">Borrowed Books</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($borrowedBooks as $borrowedBook)
                <div class="shadow-md p-4 bg-white rounded-lg">
                    <div class="rounded-lg">
                        <div class="flex gap-8 p-4 items-center rounded-lg">
                            <!-- Book Cover -->
                            <div>
                                <a href="{{ route('books.show', $borrowedBook->book->id) }}">
                                    <img src="{{ asset('storage/' . $borrowedBook->book->cover_image) }}" alt="{{ $borrowedBook->book->title }}" class="w-32 h-32 object-cover rounded-lg">
                                </a>
                            </div>

                            <!-- Book Details -->
                            <div class="flex flex-col">
                                <h2 class="text-2xl font-bold italic mb-1">{{ $borrowedBook->book->title }}</h2>
                                <hr>
                                <p class="text-md text-gray-500">Author: {{ $borrowedBook->book->author }}</p>
                                <hr>
                                <p class="text-md text-gray-500">Borrowed By: {{ $borrowedBook->user->name }}</p>
                                <hr>
                                <p class="text-md text-gray-500">Borrow Date: {{ $borrowedBook->borrowed_at }}</p>
                                <hr>
                                <p class="text-md text-gray-500">Due Date: {{ $borrowedBook->due_date }}</p>
                                <hr>

                                <x-remaining-days-message :dueDate="$borrowedBook->due_date" />
                                <hr>

                                <!-- Action Buttons -->
                                <div class="flex gap-2 mt-3">
                                    <form action="{{ route('admin.borrow-books.update', $borrowedBook->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this book as returned?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-600 py-2 px-4 text-white rounded-lg transition-transform hover:scale-105">
                                            Mark as Returned
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-gray-500 text-3xl text-center m-auto col-span-2">No borrowed books found.</p>
        @endif
    </div>
</x-layout>
