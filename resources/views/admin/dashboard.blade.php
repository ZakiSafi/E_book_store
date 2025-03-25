<x-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-admin-sidebar :user="Auth::user()" />

        <!-- Main Content -->
        <main class="flex-1 bg-gray-50 p-6 md:p-8">
            <!-- Categories and Shelves Buttons -->
            <div class="flex flex-col md:flex-row gap-4 w-full mb-8">
                <div id="categoriesButton" class="cursor-pointer w-full md:w-1/2 p-4 bg-blue-600 text-white rounded-lg text-center hover:bg-blue-700 transition-all duration-300">
                    <span class="text-lg font-semibold">Books Categories</span>
                </div>
                <div id="shelvesButton" class="cursor-pointer w-full md:w-1/2 p-4 bg-green-600 text-white rounded-lg text-center hover:bg-green-700 transition-all duration-300">
                    <span class="text-lg font-semibold">Books Shelves</span>
                </div>
            </div>

            <!-- Categories Bar -->
            <div id="categoriesBar" class="hidden my-8 w-full max-w-5xl bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Categories</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $cat)
                    <a href="/categories/{{ $cat->id }}" class="block">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm hover:bg-blue-200 hover:text-blue-900 transition-all duration-300">
                            {{ $cat->name }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Shelves Bar -->
            <div id="shelvesBar" class="hidden my-8  w-full max-w-5xl bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Shelves</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($shelfs as $shelf)
                    <a href="{{ route('admin.books.shelfs', $shelf->shelf_no) }}" class="block">
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm hover:bg-green-200 hover:text-green-900 transition-all duration-300">
                            {{ $shelf->shelf_no }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('admin.users.index') }}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-blue-600 p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-300">
                        <i class="fa-solid fa-users text-3xl text-blue-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Total Users</p>
                            <p class="text-xl font-bold group-hover:text-white transition-all duration-300">{{ $users }}</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.books.index') }}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-green-600 p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-300">
                        <i class="fa-solid fa-book text-3xl text-green-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Digital Books</p>
                            <p class="text-xl font-bold group-hover:text-white transition-all duration-300">{{ $digitalBooks }}</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.books.physicalBooks') }}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-purple-600 p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-300">
                        <i class="fa-solid fa-book text-3xl text-purple-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Physical Books</p>
                            <p class="text-xl font-bold group-hover:text-white transition-all duration-300">{{ $physicalBooks }}</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.borrow-books.index') }}">
                    <div class="flex items-center gap-4 group cursor-pointer bg-white hover:bg-red-600 p-4 rounded-lg shadow-sm border border-gray-100 transition-all duration-300">
                        <i class="fa-solid fa-exchange-alt text-3xl text-red-600 group-hover:text-white transition-all duration-300"></i>
                        <div>
                            <p class="text-gray-600 text-sm group-hover:text-white transition-all duration-300">Active Borrowings</p>
                            <p class="text-xl font-bold group-hover:text-white transition-all duration-300">{{ $borrowedBooks }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Alerts Section (Conditional) -->
            @if ($overDueBooks->count() > 0 || $pendingBooks->count() > 0 || $requestForBorrowingBook->count() > 0)
            <div class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Overdue Books -->
                    @if ($overDueBooks->count() > 0)
                    <div class="bg-red-50 p-4 rounded-lg shadow-sm border border-red-100">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-exclamation-circle text-3xl text-red-600"></i>
                            <div>
                                <p class="text-red-600 font-semibold">Overdue Books</p>
                                <p class="text-gray-600 text-sm">{{ $overDueBooks->count() > 1 ? $overDueBooks->count() . " books are overdue." : $overDueBooks->count() . " book is overdue." }}</p>
                                <a href="{{ route('admin.books.dueBooks') }}" class="text-red-600 hover:text-red-700 text-sm border-b border-red-600 hover:border-red-700">Check it</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Pending Books -->
                    @if ($pendingBooks->count() > 0)
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-sm border border-yellow-100">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-clock text-3xl text-yellow-600"></i>
                            <div>
                                <p class="text-yellow-600 font-semibold">Pending Books</p>
                                <p class="text-gray-600 text-sm">{{ $pendingBooks->count() > 1 ? $pendingBooks->count() . " books are pending." : $pendingBooks->count() . " book is pending." }}</p>
                                <a href="{{ route('admin.books.pending') }}" class="text-yellow-600 hover:text-yellow-700 text-sm border-b border-yellow-600 hover:border-yellow-700">Check it</a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Pending Borrow Requests -->
                    @if ($requestForBorrowingBook->count() > 0)
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-sm border border-yellow-100">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-clock text-3xl text-yellow-600"></i>
                            <div>
                                <p class="text-yellow-600 font-semibold">Pending Borrow Requests</p>
                                <p class="text-gray-600 text-sm">{{ $requestForBorrowingBook->count() > 1 ? $requestForBorrowingBook->count() . " requests are pending." : $requestForBorrowingBook->count() . " request is pending." }}</p>
                                <a href="{{ route('admin.borrow-request.index') }}" class="text-yellow-600 hover:text-yellow-700 text-sm border-b border-yellow-600 hover:border-yellow-700">Check it</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <canvas id="booksBorrowedChart"></canvas>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <canvas id="booksDownloadedChart"></canvas>
                </div>
            </div>

            <!-- Category Creation Modal -->
            <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 text-center sm:block sm:p-0">
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
