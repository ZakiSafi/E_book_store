<x-layout>
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <!-- Header with Search Bar, Buttons, and Sidebar Toggle Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2">Categories</h2>
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->

                    <!-- Sidebar Toggle Button -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white hidden z-50">
                            <div class="p-4">
                                <x-sideBar />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add New Category Button -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('admin.categories.create') }}"
                    class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-5 py-2 rounded-lg shadow-lg flex items-center gap-2 transition duration-300 ease-in-out">
                    <i class="fas fa-plus"></i> Add New Category
                </a>
            </div>

            <!-- Categories Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow flex items-center gap-2 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow flex items-center gap-2 transition duration-300 ease-in-out"
                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
