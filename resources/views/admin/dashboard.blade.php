<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-700 text-white shadow-lg">

            <nav class="p-4">
                <div class="flex items-center space-x-4 p-4 bg-blue-800 rounded-lg shadow-lg">
                    <div class="relative">
                        <!-- Profile Picture -->
                        <img
                            src="{{ asset('storage/'.$user->profile_picture) }}"
                            alt="profile picture"
                            class="h-16 w-16 rounded-full border-2 border-white shadow-lg transition-transform transform hover:scale-105 duration-300">

                        <!-- Edit Icon -->
                        <a
                            href="{{ route('user.profile.edit', $user->id) }}"
                            class="absolute bottom-0 right-0 bg-blue-400 rounded-lg  shadow-md transition-transform transform hover:scale-110 duration-300 text-center"
                            aria-label="Edit Profile"
                            style="transform: translate(25%, 5%);"
                            title='Edit profile'>
                            <i class="fa-solid fa-edit text-white text-xs mx-1.5 "></i>

                        </a>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                        <p class="text-[10px] text-blue-200 truncate">{{ $user->email }}</p>
                    </div>
                </div>
                <ul class="space-y-1 mt-4">

                    <!-- Manage Users with Submenu -->
                    <li class="relative">
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2 submenu-toggle" data-submenu-id="userSubmenu">
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
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2 submenu-toggle" data-submenu-id="bookSubmenu">
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
                        <p class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2 submenu-toggle" data-submenu-id="borrowedSubmenu">
                            <i class=" fa-solid fa-exchange-alt mr-3"></i> Borrowed Books
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
                    <i class="fa-solid fa-user-shield mr-3"></i> Create New Admin
                </a>
                <!-- Button to Open Modal -->
                <button id="openModal" class="flex items-center cursor-pointer p-3 hover:bg-blue-500/90 transition-all duration-300 rounded-lg mx-2">
                    <i class="fa-solid fa-folder-plus mr-3"></i> Create Category
                </button>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-8 ">
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

                <a href="{{route('admin.books.physicalBooks')}}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                        <i class="fa-solid fa-book text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Physical Books </p>
                            <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$physicalBooks}}</p>
                        </div>
                    </div>
                </a>

                <a href="{{route('admin.borrow-books.index')}}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-6 rounded-lg shadow-md transition-all duration-300">
                        <i class="fa-solid fa-exchange-alt text-3xl text-purple-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Active Borrowings</p>
                            <p class="text-2xl font-bold group-hover:text-white transition-all duration-300">{{$borrowedBooks}}</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Alerts Section (Conditional) -->
            @if ($overDueBooks->count() > 0 || $pendingBooks->count() > 0)
            <div class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Overdue Books -->
                    @if ($overDueBooks->count() > 0)
                    <div class="bg-red-100 p-4 rounded-lg shadow-md">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-exclamation-circle text-3xl text-red-600"></i>
                            <div>
                                <p class="text-red-600 font-semibold">Overdue Books</p>
                                <p class="text-gray-600 text-sm">{{ $overDueBooks->count() }} books are overdue.</p>
                            </div>
                        </div>
                        <ul class="mt-2 space-y-1">
                            @foreach ($overDueBooks as $book)
                            <li class="text-sm text-gray-600">
                                <i class="fa-solid fa-book mr-2"></i>{{ $book->title }} (Due: {{ $book->due_date }})
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Pending Books -->
                    @if ($pendingBooks->count() > 0)
                    <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-clock text-3xl text-yellow-600"></i>
                            <div>
                                <p class="text-yellow-600 font-semibold">Pending Books</p>
                                @if ($pendingBooks->count() == 1)
                                <p class="text-gray-600 text-sm">{{ $pendingBooks->count() }} book is pending to be approved!</p>
                                @else
                                <p class="text-gray-600 text-sm">{{ $pendingBooks->count() }} books are pending to be approved!</p>
                                @endif
                                <a href="{{route('admin.books.pending')}}" class="text-yellow-600 hover:text-yellow-700 text-sm border-b border-yellow-600 hover:border-yellow-700">check it</a>

                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Books Borrowed Chart -->
            <div class="chart-container">
                <canvas id="booksBorrowedChart"></canvas>
            </div>


            <!-- Books Downloaded Chart -->
            <div class="chart-container">
                <canvas id="booksDownloadedChart"></canvas>
            </div>

            <!-- category cretion popup -->
            <!-- Modal -->
            <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Modal Overlay -->
                    <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50"></div>

                    <!-- Modal Content -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold mb-4">Create New Category</h3>
                            <!-- Form -->
                            <form action="{{ route('admin.category.store') }}" method="POST" class="max-w-lg mx-auto">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
                                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" required>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" id="closePopup" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Cancel</button>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</x-layout>
