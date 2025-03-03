<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg">

            <nav class="p-4">
                <div class="flex items-center space-x-4 p-4 bg-blue-800 rounded-lg shadow-lg">
                    <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="profile picture" class="h-16 w-16 rounded-full border-2 border-white shadow-md">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                        <p class="text-[10px] text-blue-200 truncate">{{ $user->email }}</p>
                    </div>
                </div>
                <ul class="space-y-1 mt-4">

                    <!-- Manage Users with Submenu -->
                    <li class="relative">
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2" onclick="toggleSubmenu('userSubmenu')">
                            <i class="fa-solid fa-users mr-3"></i> Manage Users
                            <i id="userChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </p>
                        <ul id="userSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li class="mt-1">
                                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-list mr-3"></i> View All Users
                                </a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="flex items-center p-2 hover:bg-blue-600/90 transition-all duration-300 rounded-lg text-sm">
                                    <i class="fa-solid fa-user-plus mr-3"></i> Add New User
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Manage Books with Submenu -->
                    <li class="relative">
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2" onclick="toggleSubmenu('bookSubmenu')">
                            <i class="fa-solid fa-book mr-3"></i> Manage Books
                            <i id="bookChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </p>
                        <ul id="bookSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li class="mt-1">
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
                    <li class="relative">
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2" onclick="toggleSubmenu('borrowedSubmenu')">
                            <i class="fa-solid fa-exchange-alt mr-3"></i> Borrowed Books
                            <i id="borrowedChevron" class="fa-solid fa-chevron-right ml-auto text-sm transition-transform duration-300"></i>
                        </p>
                        <ul id="borrowedSubmenu" class="pl-8 mt-1 space-y-1 bg-blue-700/90 rounded-lg shadow-lg overflow-hidden max-h-0 transition-all duration-300">
                            <li class="mt-1">
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
                </ul>
                <a href="{{route('admin.create')}}" class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-plus mr-3"></i> Create New Admin
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-8">
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <a href="{{route('admin.users.index')}}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                        <i class="fa-solid fa-users text-3xl text-blue-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Total Users</p>
                            <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$users}}</p>
                        </div>
                    </div>
                </a>
                <a href="{{route('admin.books.index')}}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                        <i class="fa-solid fa-book text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Digital Books </p>
                            <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$digitalBooks}}</p>
                        </div>
                    </div>
                </a>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-book text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Physical Books </p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$physicalBooks}}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                    <i class="fa-solid fa-exchange-alt text-3xl text-purple-600 group-hover:text-white transition-all duration-300"></i>
                    <div>
                        <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Active Borrowings</p>
                        <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$borrowedBooks}}</p>
                    </div>
                </div>
            </div>

            <!-- Books Borrowed Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-bold mb-4">Books Borrowed Per Month</h3>
                <canvas id="booksBorrowedChart"></canvas>
            </div>

            <!-- Books Downloaded Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4">Books Downloaded Per Month</h3>
                <canvas id="booksDownloadedChart"></canvas>
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
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('Submenu', 'Chevron'));

            if (submenu.style.maxHeight) {
                submenu.style.maxHeight = null; // Collapse submenu
                chevron.classList.replace('fa-chevron-down', 'fa-chevron-right');
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + "px"; // Expand submenu
                chevron.classList.replace('fa-chevron-right', 'fa-chevron-down');
            }
        }

        document.addEventListener('click', function(event) {
            const submenus = ['userSubmenu', 'bookSubmenu', 'borrowedSubmenu'];
            submenus.forEach(submenuId => {
                const submenu = document.getElementById(submenuId);
                const chevron = document.getElementById(submenuId.replace('Submenu', 'Chevron'));
                const submenuParent = submenu.closest('li');

                if (!submenuParent.contains(event.target)) {
                    submenu.style.maxHeight = null; // Collapse submenu
                    chevron.classList.replace('fa-chevron-down', 'fa-chevron-right');
                }
            });
        });

        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                    opacityFrom: 0.55,
                    opacityTo: 0,
                    shade: "#1C64F2",
                    gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: 0
                },
            },
            series: [{
                name: "New users",
                data: [6500, 6418, 6456, 6526, 6356, 6456],
                color: "#1A56DB",
            }, ],
            xaxis: {
                categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
        }

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
    </script>
</x-layout>
