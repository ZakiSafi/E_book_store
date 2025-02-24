<x-layout>
    <!-- session -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Manage Books</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" placeholder="Search books..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <!-- Online and Physical Books Buttons -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.books.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150 ease-in-out">
                            Online Books
                        </a>
                        <a href="{{ route('admin.books.physicalBooks') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-150 ease-in-out">
                            Physical Books
                        </a>
                    </div>

                    <!-- Sidebar Toggle Button (Visible on all screen sizes) -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown (Hidden by default) -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg hidden">
                            <div class="p-4">
                                <x-sideBar />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Books List</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookmarks</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @foreach ($books as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('books.show', $book->id)}}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class=" whitespace-nowrap">
                                <a href="{{route('books.show', $book->id)}}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->bookmarks->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-4">
                                    <a href="{{route('user.books.edit',$book->id)}}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <form action="{{route('user.books.destroy',$book->id)}}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                            <i class="fa-solid fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $books->links() }}
        </div>
    </div>

    <!-- JavaScript to handle sidebar toggle -->
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarDropdown = document.getElementById('sidebar-dropdown');

        sidebarToggle.addEventListener('click', () => {
            sidebarDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!sidebarToggle.contains(e.target) && !sidebarDropdown.contains(e.target)) {
                sidebarDropdown.classList.add('hidden');
            }
        });
    </script>
</x-layout>
