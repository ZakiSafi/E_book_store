<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <div class="p-4 rounded-lg shadow-lg col-span-1">
            <div class="flex flex-col gap-3 text-[#666] text-lg">
                <a href="/admin" class="group">
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
                <a href="/admin/bookmarks" class="group">
                    <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
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

            <!-- Profile Section -->
            <div class="flex items-center space-x-4 mt-8 mb-6">
                <!-- Profile Picture -->
                <div class="flex-shrink-0">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="w-32 h-32 rounded-full border-2 border-gray-300">
                </div>
                <!-- User Info -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">John Doe</h3>
                    <p class="text-gray-600">johndoe@example.com</p>
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Total Books</h3>
                    <p class="text-2xl font-bold text-blue-600">23</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Registered Users</h3>
                    <p class="text-2xl font-bold text-blue-600">234</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800">Total Bookmarks</h3>
                    <p class="text-2xl font-bold text-blue-600">234</p>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="flex gap-4">
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <h4 class="text-lg font-semibold text-gray-800">Recent Books</h4>
                        <ul class="list-disc pl-6">
                            2342342
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md flex-1">
                        <h4 class="text-lg font-semibold text-gray-800">Recent Users</h4>
                        <ul class="list-disc pl-6">
                            2342342
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="/admin/books/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fa-solid fa-plus mr-2"></i> Upload New Book
                    </a>
                    <a href="/admin/users" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fa-solid fa-users mr-2"></i> Manage Users
                    </a>
                    <a href="/admin/bookmarks" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition duration-300">
                        <i class="fa-solid fa-bookmark mr-2"></i> View Bookmarks
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
