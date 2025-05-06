<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-[minmax(250px,20%),1fr] gap-4 ">
        <!-- Sidebar -->
        @auth
        @if (Auth::user()->role == 'admin')
        <x-admin-sidebar :user="Auth::user()" />
        @elseif (Auth::user()->role == 'user')
        <x-user-sidebar :user="Auth::user()" />
        @endif
        @endauth
        <!-- Main Content -->
        <div class="shadow-md p-4 sm:p-6 bg-white rounded-lg">
            @if ($books->isNotEmpty())
            <div class="grid gap-4 sm:gap-6 rounded-lg">
                @foreach ($books as $book)
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 p-4 sm:p-6 items-center rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <!-- Book Cover -->
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('books.show',['book' => $book->id] )}}">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="w-full sm:w-32 h-32 sm:h-40 object-cover rounded-lg shadow-md hover:opacity-90 transition-opacity">
                        </a>
                    </div>

                    <!-- Book Details -->
                    <div class="flex-1 flex flex-col w-full">
                        <h2 class="text-xl sm:text-2xl font-bold italic mb-1 truncate">{{ $book->title }}</h2>
                        <div class="space-y-2 my-1">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm sm:text-base">Author:</span>
                                <span class="text-gray-700">{{ $book->author }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm sm:text-base">Category:</span>
                                <span class="text-blue-600 font-medium">{{ $book->category->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm sm:text-base">File Size:</span>
                                <span class="text-gray-700">
                                    @if ($book->file_size < 1024)
                                        {{ $book->file_size }} bytes
                                        @elseif ($book->file_size < 1048576)
                                            {{ round($book->file_size / 1024, 2) }} KB
                                            @else
                                            {{ round($book->file_size / 1048576, 2) }} MB
                                            @endif
                                            </span>
                            </div>
                            {{-- Status Tag --}}
                            <span class="text-[10px] font-semibold px-2 py-1 rounded-full
    {{ $book->status === 'approved' ? 'bg-green-100 text-green-600' :
       ($book->status === 'rejected' ? 'bg-red-100 text-red-600' :
       'bg-yellow-100 text-yellow-600') }}">
                                {{ ucfirst($book->status) }}
                            </span>

                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-2 mt-3">
                            <a href="{{route('user.books.edit',$book->id)}}"
                                class="bg-blue-600 py-2 px-4 text-white rounded-lg hover:bg-blue-700 transition-colors text-center text-sm sm:text-base">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('user.books.destroy', $book->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this book?')" class="w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-600 py-2 px-4 text-white rounded-lg hover:bg-red-700 transition-colors text-sm sm:text-base">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-6 text-center bg-gray-50 rounded-lg">
                <p class="text-gray-500 text-lg">No books added yet.</p>

            </div>
            @endif
            <div class="text-center bg-gray-50 rounded-lg">
                <a href="{{ route('user.books.create') }}"
                    class="mt-4 inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-1"></i> Add Your First Book
                </a>
            </div>
        </div>


</x-layout>
