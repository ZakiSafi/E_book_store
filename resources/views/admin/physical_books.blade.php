<x-layout>
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
                        <a href="{{ route('admin.books.index') }}" class="px-4 py-2 {{ request()->routeIs('admin.books.index') ? 'bg-blue-700' : 'bg-blue-500' }} text-white rounded-lg hover:bg-blue-600 transition duration-150 ease-in-out">
                            Online Books
                        </a>
                        <a href="{{ route('admin.books.physicalBooks') }}" class="px-4 py-2 {{ request()->routeIs('admin.books.physicalBooks') ? 'bg-green-700' : 'bg-green-500' }} text-white rounded-lg hover:bg-green-600 transition duration-150 ease-in-out">
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
            <div class="mt-8 mb-4 ">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Books List</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Language</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shelf No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available copies</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @foreach ($books as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('physicalBooks.show', $book->id)}}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $book->title }}
                                </a>
                            </td>
                            <td class=" whitespace-nowrap">
                                <a href="{{route('physicalBooks.show', $book->id)}}">
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->author }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->language }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->shelf_no }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->available_copies }}</td>

                            <td class="px-6 py-4 whitespace-nowrap relative">
                                <div class="action-toggle cursor-pointer">
                                    <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                                </div>

                                <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                    <i class="fa-solid fa-edit text-sm text-blue-600"></i>
                                    <a href="{{ route('user.books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-150 ease-in-out">
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
            </div>
            {{ $books->links() }}
        </div>
    </div>

</x-layout>
