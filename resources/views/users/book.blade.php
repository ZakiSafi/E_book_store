<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar -->
        <h1 class="text-3xl font-bold font-sans col-span-3">Books Added by You</h1>
        <x-sideBar />

        <!-- Main Content -->
        <div class="shadow-md col-span-2 p-4 bg-white rounded-lg ">

            @if ($books->isNotEmpty())
            <div class="grid gap-4 rounded-lg">
                @foreach ($books as $book)
                <div class="flex gap-8 p-4 items-center rounded-lg shadow-lg">
                    <!-- Book Cover -->
                    <div>
                        <a href="{{ route('books.show'), $book->id }}">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-64 h-42 object-cover rounded-lg">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex flex-col">
                        <h2 class="text-2xl font-bold italic mb-1 ">{{ $book->title }}</h2>
                        <hr>
                        <p class="text-md text-gray-500">Author: {{ $book->author }}</p>
                        <hr>
                        <p class="text-md text-gray-500 ">Category: {{ $book->category->name }}</p>
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
                                        <a href="{{route('user.books.edit',$book->id)}}" class="bg-blue-600 py-2 px-4 text-white rounded-lg transition-transform hover:scale-105">
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
                @endforeach
            </div>
            @else
            <p class="p-4 text-gray-500 text-center">No books added yet.</p>
            @endif
        </div>
    </div>
</x-layout>
