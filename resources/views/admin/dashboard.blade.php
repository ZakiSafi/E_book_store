<x-layout>
    <!-- Success Message -->
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

    <!-- Main Container -->
    <div class="container w-full max-w-7xl p-4 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <x-sideBar />

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg md:col-span-2">
            <h2 class="text-2xl font-bold mb-4 border-b-2">Admin Dashboard</h2>

            <!-- Pending Books Alert -->
            @if($pendingBooks > 0)
            <div class="bg-yellow-500 text-white text-center py-2 px-4 rounded-lg mb-4">
                <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                There are <strong>{{ $pendingBooks }}</strong> books pending approval!
                <a href="{{route('admin.books.pending')}}" class="underline font-bold">Review now</a>
            </div>
            @endif

            <!-- Profile Section -->
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 mt-8 mb-6">
                <!-- Profile Picture -->
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-24 w-24 cursor-pointer">
                    @else
                    <img src="{{ asset('storage/profile_pictures/default.jfif') }}" alt="Default Profile Picture" class="rounded-full h-24 w-24">
                    @endif
                  
                </div>
                <!-- User Info -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h3>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <a href="{{route('admin.books.index')}}">
                        <h3 class="text-lg font-semibold text-gray-800">Total Books</h3>
                        <p class="text-2xl font-bold text-blue-600">{{ $books }}</p>
                    </a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <a href="{{route('admin.users.index')}}">
                        <h3 class="text-lg font-semibold text-gray-800">Registered Users</h3>
                        <p class="text-2xl font-bold text-blue-600">{{$users}}</p>
                    </a>
                </div>

            </div>

            <!-- Recent Activity Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="flex flex-col md:flex-row gap-4">
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
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{route('user.books.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 text-center">
                        <i class="fa-solid fa-plus mr-2"></i> Upload New Book
                    </a>
                    <a href="{{route('admin.users.index')}}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 text-center">
                        <i class="fa-solid fa-users mr-2"></i> Manage Users
                    </a>
                    <a href="{{route('admin.books.index')}}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-300 text-center">
                        <i class="fa-solid fa-bookmark mr-2"></i> Manage Books
                    </a>
                    <a href="{{ route('admin.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 text-center">
                        <i class="fa-solid fa-user-shield mr-2"></i> Create New Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="profileModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-xl">
            <button id="close-popup" class="text-xl hover:bg-red-600 hover:text-white px-2 py-1 rounded-lg transition-transform transform hover:scale-105 duration-300">Close</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
                <h2 class="text-2xl">{{ $user->name }}</h2>
                <p class="mt-2">{{ $user->email }}</p>
            </div>
        </div>
    </div>
</x-layout>
