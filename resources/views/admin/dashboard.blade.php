<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8 ">
        <!-- Sidebar Navigation -->
        <div class="p-4 rounded-lg shadow-lg col-span-1 self-start">
            <div class="flex flex-col gap-3 text-[#666] text-lg ">
                <a href="/admin/dashboard" class="group">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>
                <a href="/admin/books" class="group">
                    <i class="fa-solid fa-book text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage Books</span>
                </a>
                <a href="/admin/users" class="group">
                    <i class="fa-solid fa-users text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage Users</span>
                </a>
                <a href="/admin/settings" class="group">
                    <i class="fa-solid fa-cogs text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Settings</span>
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-2">
            <h2 class="text-2xl font-bold mb-4 border-b-2">Admin Dashboard</h2>
            @if($pendingBooks > 0)
            <div class="bg-yellow-500 text-white text-center py-2 px-4 rounded-lg mb-4">
                <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                There are <strong>{{ $pendingBooks }}</strong> books pending approval!
                <a href="{{route('books.pending')}}" class="underline font-bold">Review now</a>
            </div>
            @endif

            <!-- Profile Section -->
            <div class="flex space-x-4 mt-8 mb-6">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-24 w-24 cursor-pointer" onclick="openProfileModal()">
                    @else
                    <img src="{{ asset('storage/profile_pictures/default.jfif') }}" alt="Default Profile Picture" class="rounded-full h-24 w-24">
                    @endif
                    <a href="/profile" class="text-md bg-red-500 text-white transition-color duratino-300 hover:bg-red-600 rounded-lg px-4 py-1 ">Edit</a>
                </div>
                <!-- User Info -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <a href="/admin/books">
                        <h3 class="text-lg font-semibold text-gray-800">Total Books</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $books }}</p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <a href="/admin/users">
                        <h3 class="text-lg font-semibold text-gray-800">Registered Users</h3>
                        <p class="text-2xl font-bold text-blue-600">{{$users}}</p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <a href="/admin/books">
                        <h3 class="text-lg font-semibold text-gray-800">Total Bookmarks</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $bookmarks }}</p>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="flex gap-4">
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <h4 class="text-lg font-semibold text-gray-800">Recent Books</h4>
                        <ul class="text-2xl font-bold text-blue-600 pl-6">
                            {{$booksLast2Days}}
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <h4 class="text-lg font-semibold text-gray-800">Recent Users</h4>
                        <ul class="text-2xl font-bold text-blue-600 pl-6">
                            {{ $usersLast2Days }}
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="/books/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fa-solid fa-plus mr-2"></i> Upload New Book
                    </a>
                    <a href="/admin/users" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fa-solid fa-users mr-2"></i> Manage Users
                    </a>
                    <a href="/admin/books" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-300">
                        <i class="fa-solid fa-bookmark mr-2"></i> Manage Books
                    </a>
                    <a href="{{ route('admin.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                        <i class="fa-solid fa-user-shield mr-2"></i> Create New Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
