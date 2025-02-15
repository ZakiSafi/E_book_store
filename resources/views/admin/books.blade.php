<x-layout>
    @if (session('success'))
    <div class="bg-green-500 text-white py-2">
        {{ session('success') }}
    </div>

    @endif
    <div class="container w-full max-w-7xl p-8 grid grid-cols-1 sm:grid-cols-4 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <x-sideBar />
        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-1 sm:col-span-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold mb-4 border-b-2">Manage Books</h2>
                <div class="text-sm">Total books: {{ $totalBooks }}</div>
            </div>

            <!-- Books Table Section -->
            <div class="mt-8 mb-2 overflow-x-auto">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Books List</h3>
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Cover Image</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Uploaded By</th>
                            <th class="px-4 py-2 text-left">Bookmarks</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($books as $book)
                        <tr class="border-b">
                            <td class="px-4 py-2">
                                <a href="{{route('books.show', $book->id)}}">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{route('books.show', $book->id)}}">
                                    <img src=" {{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-24 object-cover shrink-0 ">
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $book->author }}</td>
                            <td class="px-4 py-2">{{ $book->user->name }}</td>
                            <td class="px-4 py-2">{{ $book->bookmarks->count() }}</td>
                            <td class="px-4 py-2 flex space-x-4">
                                <a href="{{'books.edit',$book->id}}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </a>
                                <form action="{{route('books.store',$book->id)}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $books->links() }}
        </div>
    </div>
</x-layout>