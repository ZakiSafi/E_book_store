<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="mt-6">
                <ul class="space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                            <i class="fa-solid fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>

                    <!-- Manage Users with Submenu -->
                    <li class="relative" onmouseenter="toggleSubmenu('userSubmenu', true)" onmouseleave="toggleSubmenu('userSubmenu', false)">
                        <a href="#" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                            <i class="fa-solid fa-users mr-3"></i> Manage Users
                            <i id="userChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </a>
                        <ul id="userSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li>
                                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-list mr-3"></i> View All Users
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-user-plus mr-3"></i> Add New User
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Manage Books with Submenu -->
                    <li class="relative" onmouseenter="toggleSubmenu('bookSubmenu', true)" onmouseleave="toggleSubmenu('bookSubmenu', false)">
                        <a href="#" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                            <i class="fa-solid fa-book mr-3"></i> Manage Books
                            <i id="bookChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </a>
                        <ul id="bookSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li>
                                <a href="{{ route('admin.books.index') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-file-pdf mr-3"></i> Digital Books
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.books.physicalBooks') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-book-open mr-3"></i> Physical Books
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.books.create') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-plus mr-3"></i> Create Digital Book
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.physical-books.create') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-plus mr-3"></i> Create Physical Book
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Borrowed Books with Submenu -->
                    <li class="relative" onmouseenter="toggleSubmenu('borrowedSubmenu', true)" onmouseleave="toggleSubmenu('borrowedSubmenu', false)">
                        <a href="#" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                            <i class="fa-solid fa-exchange-alt mr-3"></i> Borrowed Books
                            <i id="borrowedChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </a>
                        <ul id="borrowedSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li>
                                <a href="{{ route('admin.borrow-books.index') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-list mr-3"></i> Current Borrowed Books
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.borrow-books.history') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-history mr-3"></i> History of Borrowed Books
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li>
                        <a href="#" class="flex items-center p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                            <i class="fa-solid fa-cogs mr-3"></i> Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>




        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-8">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-users text-3xl text-blue-600"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Total Users</p>
                            <p class="text-2xl font-bold">1,234</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-book text-3xl text-green-600"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Total Books</p>
                            <p class="text-2xl font-bold">5,678</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-exchange-alt text-3xl text-purple-600"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Active Borrowings</p>
                            <p class="text-2xl font-bold">123</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-dollar-sign text-3xl text-yellow-600"></i>
                        <div>
                            <p class="text-gray-600 text-sm">Revenue</p>
                            <p class="text-2xl font-bold">$12,345</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs and Analytics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class=" p-5">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <!-- Widget Heading -->
                        <div class="mb-4">
                            <h5 class="text-xl font-bold text-gray-800">Recent Activities</h5>
                        </div>

                        <!-- Timeline -->
                        <div class="space-y-4">
                            <!-- Timeline Item - Primary -->
                            <div class="flex items-start relative">
                                <!-- Dot -->
                                <div class="w-3 h-3 bg-blue-600 border-2 border-blue-200 rounded-full absolute left-0 top-2"></div>
                                <!-- Text -->
                                <div class="ml-6 flex-1">
                                    <p class="text-sm text-gray-600">Updated Server Logs</p>
                                    <span class="absolute left-6 text-xs bg-red-500 text-white px-2 py-1 rounded opacity-0 hover:opacity-100 transition-opacity">Pending</span>
                                    <p class="text-xs text-gray-500 mt-1">Just Now</p>
                                </div>
                            </div>

                            <!-- Timeline Item - Success -->
                            <div class="flex items-start relative">
                                <!-- Dot -->
                                <div class="w-3 h-3 bg-green-500 border-2 border-green-200 rounded-full absolute left-0 top-2"></div>
                                <!-- Text -->
                                <div class="ml-6 flex-1">
                                    <p class="text-sm text-gray-600">Send Mail to HR and Admin</p>
                                    <span class="absolute left-6 text-xs bg-green-500 text-white px-2 py-1 rounded opacity-0 hover:opacity-100 transition-opacity">Completed</span>
                                    <p class="text-xs text-gray-500 mt-1">2 min ago</p>
                                </div>
                            </div>

                            <!-- Timeline Item - Danger -->
                            <div class="flex items-start relative">
                                <!-- Dot -->
                                <div class="w-3 h-3 bg-red-500 border-2 border-red-200 rounded-full absolute left-0 top-2"></div>
                                <!-- Text -->
                                <div class="ml-6 flex-1">
                                    <p class="text-sm text-gray-600">Backup Files EOD</p>
                                    <span class="absolute left-6 text-xs bg-red-500 text-white px-2 py-1 rounded opacity-0 hover:opacity-100 transition-opacity">Pending</span>
                                    <p class="text-xs text-gray-500 mt-1">14:00</p>
                                </div>
                            </div>

                            <!-- Timeline Item - Dark -->
                            <div class="flex items-start relative">
                                <!-- Dot -->
                                <div class="w-3 h-3 bg-gray-700 border-2 border-gray-400 rounded-full absolute left-0 top-2"></div>
                                <!-- Text -->
                                <div class="ml-6 flex-1">
                                    <p class="text-sm text-gray-600">Collect documents from Sara</p>
                                    <span class="absolute left-6 text-xs bg-green-500 text-white px-2 py-1 rounded opacity-0 hover:opacity-100 transition-opacity">Completed</span>
                                    <p class="text-xs text-gray-500 mt-1">16:00</p>
                                </div>
                            </div>

                            <!-- Timeline Item - Warning -->
                            <div class="flex items-start relative">
                                <!-- Dot -->
                                <div class="w-3 h-3 bg-yellow-500 border-2 border-yellow-200 rounded-full absolute left-0 top-2"></div>
                                <!-- Text -->
                                <div class="ml-6 flex-1">
                                    <p class="text-sm text-gray-600">Conference call with Marketing Manager</p>
                                    <span class="absolute left-6 text-xs bg-blue-500 text-white px-2 py-1 rounded opacity-0 hover:opacity-100 transition-opacity">In Progress</span>
                                    <p class="text-xs text-gray-500 mt-1">17:00</p>
                                </div>
                            </div>
                        </div>

                        <!-- View All Button -->
                        <div class="text-center mt-6">
                            <button class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                                View All
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Most Borrowed Books</h3>
                    <canvas id="barChart"></canvas> <!-- Bar Chart -->
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-2">Recent Users</h4>
                        <ul class="text-gray-600">
                            <li>User 1</li>
                            <li>User 2</li>
                            <li>User 3</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-2">Recent Books</h4>
                        <ul class="text-gray-600">
                            <li>Book 1</li>
                            <li>Book 2</li>
                            <li>Book 3</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mb-2">Recent Borrowings</h4>
                        <ul class="text-gray-600">
                            <li>Borrowing 1</li>
                            <li>Borrowing 2</li>
                            <li>Borrowing 3</li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleSubmenu(submenuId, isOpen) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('Submenu', 'Chevron'));

            if (isOpen) {
                submenu.style.maxHeight = submenu.scrollHeight + "px"; // Expand submenu
                chevron.classList.replace('fa-chevron-right', 'fa-chevron-down');
            } else {
                submenu.style.maxHeight = "0"; // Collapse submenu
                chevron.classList.replace('fa-chevron-down', 'fa-chevron-right');
            }
        }
    </script>
</x-layout>
