<x-layout>
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Borrow Request History</h2>
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

            @if ($borrowedBooksRequestsHistory->count() > 0)
            <!-- Books Table Section -->
            <div class="mt-8 mb-4 ">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approve Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Approved By</th>

                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($borrowedBooksRequestsHistory as $book)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                @if ($book->user->profile_picture)
                                <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @else
                                <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                                @endif
                                {{ $book->user->name }}
                            </td>

                            <td class="px-6 text-left py-4 whitespace-nowrap">
                                <a href="{{ route('physicalBooks.show', $book->book->id) }}" class="text-blue-600  hover:text-blue-800 font-medium">
                                    {{Str::limit( $book->book->title, 15) }}
                                </a>
                            </td>

                            <td class="whitespace-nowrap">
                                <a href="{{ route('physicalBooks.show', $book->book->id) }}">
                                    <img src="{{ asset('storage/' . $book->book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                </a>
                            </td>

                            <td class="px-6 text-left py-4 whitespace-nowrap text-gray-700">{{ $book->requested_at}}</td>

                            <td class="px-6 text-left py-4 whitespace-nowrap text-gray-700">
                                {{ $book->processed_at }}
                            </td>

                            <td class="px-6 text-left py-4 whitespace-nowrap text-gray-700">
                                {{ $book->admin->name }}
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
                <h1 class="text-3xl font-bold text-center"> No Borrow Requests History!</h1>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $borrowedBooksRequestsHistory->links() }}
            </div>
            @endif
        </div>
    </div>
</x-layout>