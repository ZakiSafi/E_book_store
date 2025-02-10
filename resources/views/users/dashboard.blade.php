<x-layout>
    @if(session('success'))
    <div id="success-message" class="bg-green-500 text-white text-center py-2">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
    @endif
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <div class="p-4 rounded-lg shadow-lg col-span-1">
            <div class="flex flex-col gap-3 text-[#666] text-lg">
                <a href="/users" class="group">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>
                <a href="/user/books" class="group">
                    <i class="fa-solid fa-book text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage Your Books</span>
                </a>
                <a href="/profile" class="group">
                    <i class="fa-solid fa-user text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
                </a>
                <a href="/bookmarks" class="group">
                    <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
                </a>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-2">
            <h2 class="text-2xl font-bold mb-4 border-b-2">Dashboard</h2>

            <!-- User Greeting Section -->
            <div class="flex gap-4">
                <div>
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-24 w-24 cursor-pointer" onclick="openProfileModal()">
                    @else
                    <img src="{{ asset('storage/profile_pictures/default.jfif') }}" alt="Default Profile Picture" class="rounded-full h-24 w-24">
                    @endif
                </div>
                <div>
                    <p class="text-gray-700"><span class="inline-block text-md font-semibold">Hello</span>, {{ $user->name }}</p>
                    <p class="text-gray-700">Welcome to your dashboard</p>
                    <p class="text-gray-500">
                        Last Login:
                        @if ($lastLoginDate)
                        {{ $lastLoginDate->diffForHumans() }}
                        @else
                        Now
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Books Uploaded</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $user->books->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Bookmarks</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $user->bookmarks->count() }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Last Upload</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        @if ($lastUploadedBook)
                        {{$lastUploadedBook->created_at->setTimezone('Asia/Kabul')->diffForHumans()}}
                        @else
                        No books uploaded yet
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="/books/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fa-solid fa-plus mr-2"></i> Upload Book
                    </a>
                    <a href="/bookmarks" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fa-solid fa-bookmark mr-2"></i> View Bookmarks
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Picture Modal -->
    <div id="profileModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-xl">
            <button onclick="closeProfileModal()" class="text-xl hover:bg-red-600 hover:text-white px-2 py-1 rounded-lg transition-transform transform hover:scale-105 duration-300">Close</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
                <h2 class="text-2xl">{{ $user->name }}</h2>
                <p class="mt-2">{{ $user->email }}</p>
                <!-- Add more profile details as needed -->
            </div>
        </div>
    </div>
</x-layout>
