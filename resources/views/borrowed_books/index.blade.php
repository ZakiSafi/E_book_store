<x-layout>
    <!-- session -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Borrowed Books</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" placeholder="Search books..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <!-- Sidebar Toggle Button  -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white  hidden z-50">
                            <div class="p-4">
                                <x-sideBar />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($borrowedBooks as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('books.show', $book->book->id)}}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $book->book->title }}
                                </a>
                            </td>
                            <td class=" whitespace-nowrap">
                                <a href="{{route('physicalBooks.show', $book->book->id)}}">
                                    <img src="{{ asset('storage/' . $book->book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                </a>
                            </td>
                            <td class="flex flex-col items-center justify-center gap-y-2 px-6 py-4 whitespace-nowrap text-gray-700">
                                @if ($book->user->profile_picture)
                                <img src="{{ asset('storage/' .  $book->user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @else
                                <img src="{{ asset('storage/profile_pictures/' . 'default.png') }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @endif

                                {{ $book->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->borrowed_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->due_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap relative">
                                <div class="action-toggle cursor-pointer">
                                    <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                                </div>

                                <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                    <i class="fa-solid fa-edit text-sm text-blue-600"></i>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm transition duration-150 ease-in-out">
                                        Edit
                                    </a>
                                    <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                    <form action="#" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                            Delete
                                        </button>
                                    </form>

                                    <!-- Mark as Returned Form -->
                                    <i class="fa-solid fa-check text-sm text-green-600"></i>
                                    <form action="{{ route('admin.borrow-books.update', $book->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm transition duration-150 ease-in-out">
                                            Mark as Returned
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- profile picture popup -->
                        <x-profile-popup>
                            <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
                            <h2 class="text-2xl">{{ $book->user->name }}</h2>
                            <p class="mt-2">{{ $book->user->email }}</p>
                        </x-profile-popup>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>