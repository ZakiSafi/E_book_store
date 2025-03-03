<x-layout>
    <!-- session -->
    <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Manage Users</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <x-admin-search :value="$searchType" />

                    <!-- Sidebar Toggle Button (Visible on all screen sizes) -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown (Hidden by default) -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white hidden z-50">
                            <div class="p-4">
                                <x-sideBar />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Books</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed Books</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookmarks</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">

                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 border object-cover rounded-full shrink-0">
                                @else
                                <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="w-24 h-24 border object-cover rounded-full shrink-0">
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.users.books', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $user->Onlinebooks->count() }}
                                </a>
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.users.books', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $user->borrowedBooks->count() }}
                                </a>
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->bookmarks->count() }}</td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
