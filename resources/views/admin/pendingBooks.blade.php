<x-layout>
    <!-- session -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-8 grid grid-cols-4 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <x-sideBar />

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-3">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold mb-4 border-b-2">Pending Books</h2>

            </div>
            @if ($pendingBooks->count()>0)
            <!-- Books Table Section -->
            <div class="mt-8 mb-2">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Cover Image</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Uploaded By</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingBooks as $book)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $book->title }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('books.show',$book-id) }}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-24 object-cover shrink-0 ">
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $book->author }}</td>
                            <td class="px-4 py-2">{{ $book->user->name }}</td>
                            <td class="px-4 py-2 flex space-x-4">
                                <form action="{{ route('admin.books.updateStatus', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" name="action" value="approve" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                        Approve
                                    </button>

                                    <button type="submit" name="action" value="reject" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Reject
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="flex items-center justify-center h-[70%] overflow-hidden">
                <h1 class="text-3xl font-bold text-center"> No Books in Pending</h1>
            </div>
            @endif



        </div>
    </div>
</x-layout>
