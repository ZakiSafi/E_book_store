<x-layout>
    <!-- Main Content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">
                    Books on Shelf #{{ $shelf_no }}
                </h2>
                <a href="{{ route('admin.books.physicalBooks') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-150 ease-in-out">
                    Back to All Physical Books
                </a>
            </div>

            <!-- Books Table -->
            <div class="mt-8 mb-4">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Books List</h3>

                @if($books->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cover</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Language</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Copies</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Available</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($books as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4">
                                <a href="{{ route('physicalBooks.show', $book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap">
                                <a href="{{ route('physicalBooks.show', $book->id) }}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="w-20 h-20 object-cover rounded-lg shadow-sm hover:shadow-md transition duration-200">
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-700">{{ Str::limit($book->author, 15) }}</td>
                            <td class="px-6 py-4 text-center text-gray-700">{{ $book->language }}</td>
                            <td class="px-6 py-4 text-center text-gray-700">{{ $book->copies }}</td>
                            <td class="px-6 py-4 text-center text-gray-700">{{ $book->available_copies }}</td>
                            <td class="px-6 py-4 whitespace-nowrap relative">
                                <div class="action-toggle cursor-pointer">
                                    <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                                </div>

                                <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                    <i class="fa-solid fa-edit text-sm text-blue-600"></i>
                                    <a href="{{ route('admin.physical-books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-150 ease-in-out">
                                        Edit
                                    </a>
                                    <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                    <form action="{{ route('admin.physical-books.destroy', $book->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                            Delete
                                        </button>
                                    </form>
                                    <i class="fa-solid fa-book-open text-sm text-green-600"></i>
                                    <a href="{{ route('admin.borrow-books.create',$book->id) }}" class="text-green-600 hover:text-green-800 text-sm transition duration-150 ease-in-out">
                                        Borrow
                                    </a>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-gray-600 text-center text-lg mt-4">No books found on this shelf.</p>
                @endif
            </div>

            <!-- Pagination -->
            {{ $books->links() }}
        </div>
    </div>
</x-layout>