@props(['user'])

<aside class="w-64 bg-gradient-to-b  from-blue-600 to-blue-700 text-white shadow-lg z-1">
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
