<x-layout>
    <!-- session -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Borrow Requests</h2>
                <div class="flex items-center space-x-4">


                    <!-- Sidebar Toggle Button  -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white hidden z-50">
                            <div class="p-4">
                                <x-sideBar />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($borrowedBooksRequests->count() > 0)
            <!-- Books Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($borrowedBooksRequests as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('physicalBooks.show', $book->book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $book->book->title }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap">
                                <a href="{{ route('physicalBooks.show', $book->book->id) }}">
                                    <img src="{{ asset('storage/' . $book->book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->book->author }}</td>
                            <td class="flex flex-col items-center justify-center gap-y-2 px-6 text-center py-4 whitespace-nowrap text-gray-700">
                                @if ($book->user->profile_picture)
                                <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @else
                                <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @endif
                                {{ $book->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap relative">
                                <div class="flex space-x-4">
                                    <form action="{{ route('admin.borrow-books.create') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->book->id }}">
                                        <input type="hidden" name="user_id" value="{{ $book->user->id }}">
                                        <button type="submit" name="action" value="approve" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                            Approve
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
            @else
            <div class="flex items-center justify-center h-[70%] overflow-hidden">
                <h1 class="text-3xl font-bold text-center"> No request found!</h1>
            </div>
            @endif
        </div>
    </div>
</x-layout>