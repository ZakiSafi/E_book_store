<x-layout>
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Sidebar -->
            <x-sideBar />

            <!-- Main Content -->
            <div class="md:col-span-3 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Admin Dashboard</h2>

                <!-- Alerts -->
                @if($pendingBooks > 0)
                <div class="bg-yellow-500 text-white text-center py-2 px-4 rounded-lg mb-4">
                    <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                    There are <strong>{{ $pendingBooks }}</strong> books pending approval!
                    <a href="{{ route('admin.books.pending') }}" class="underline font-bold">Review now</a>
                </div>
                @endif

                <!-- Profile Section -->
                <div class="flex items-center space-x-4 bg-gray-100 p-4 rounded-lg">
                    <div>
                        @if ($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-20 w-20 border-2 border-gray-300">
                        @else
                        <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Default Profile Picture" class="rounded-full h-20 w-20">
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                    <div class="bg-blue-100 p-4 rounded-lg text-center shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800">Total Books</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $books }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg text-center shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800">Registered Users</h3>
                        <p class="text-2xl font-bold text-green-600">{{ $users }}</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg text-center shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800">Bookmarks</h3>
                        <p class="text-2xl font-bold text-yellow-600">{{ $bookmarks }}</p>
                    </div>
                    <!-- Uncomment when implemented -->
                    <!-- <div class="bg-red-100 p-4 rounded-lg text-center shadow-md">
                        <h3 class="text-lg font-semibold text-gray-800">Borrowed Books</h3>
                        <p class="text-2xl font-bold text-red-600">{{ $borrowedBooks }}</p>
                    </div> -->
                </div>

                <!-- Recent Activity -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold text-gray-800">Recent Books</h4>
                            <ul class="list-disc list-inside text-gray-600">
                                {{ $booksLast2Days }}
                            </ul>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold text-gray-800">Recent Users</h4>
                            <ul class="list-disc list-inside text-gray-600">
                                {{ $usersLast2Days }}
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <a href="" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 text-center">
                            <i class="fa-solid fa-plus mr-2"></i> Upload New Book
                        </a>
                        <a href="" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 text-center">
                            <i class="fa-solid fa-users mr-2"></i> Manage Users
                        </a>
                        <a href="" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-300 text-center">
                            <i class="fa-solid fa-book mr-2"></i> Manage Books
                        </a>
                        <a href="" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 text-center">
                            <i class="fa-solid fa-user-shield mr-2"></i> Create New Admin
                        </a>
                        <a href="" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-300 text-center">
                            <i class="fa-solid fa-book-medical mr-2"></i> Add Physical Book
                        </a>
                        <!-- Uncomment when implemented -->
                        <!-- <a href="" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 text-center">
                            <i class="fa-solid fa-chart-line mr-2"></i> View Reports
                        </a> -->
                    </div>
                </div>

                <!-- Reports & Analytics (Uncomment when implemented) -->
                <!-- <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Reports & Analytics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold text-gray-800">Most Borrowed Books</h4>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach($mostBorrowedBooks as $book)
                                    <li>{{ $book->title }} ({{ $book->borrow_count }} times)</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold text-gray-800">Active Users</h4>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach($activeUsers as $user)
                                    <li>{{ $user->name }} ({{ $user->activity_count }} actions)</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</x-layout>