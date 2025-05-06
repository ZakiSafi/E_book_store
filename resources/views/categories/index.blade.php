<x-layout>
    <!-- main content -->
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white border border-gray-100">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 pb-2 relative inline-block">
                        Categories
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-300 rounded-full"></span>
                    </h2>
                    <p class="text-gray-500 mt-1">Total {{ count($categories) }} categories</p>
                </div>

                <div class="flex items-center space-x-4 w-full sm:w-auto">
                    <!-- Sidebar Toggle Button -->
                    <div class="relative">
                        <button id="sidebar-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                            <i class="fa-solid fa-bars text-gray-600"></i>
                        </button>
                        <!-- Sidebar Dropdown -->
                        <div id="sidebar-dropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-xl rounded-lg hidden z-50 border border-gray-200">

                            <x-sideBar />

                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Table Section -->
            <div class="mt-8 mb-4 overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-12">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $index => $category)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-medium">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-tag text-blue-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-gray-900 font-medium" id="category-name-{{ $category->id }}">{{ $category->name }}</div>
                                        <div class="text-gray-500 text-sm">Created {{ $category->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <!-- Edit Button (now triggers modal) -->
                                    <button onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')"
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow flex items-center gap-2 transition duration-300 ease-in-out transform hover:scale-105">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete Button (unchanged) -->
                                    <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow flex items-center gap-2 transition duration-300 ease-in-out transform hover:scale-105"
                                            onclick="return confirm('Are you sure you want to delete {{$category->name}} category?')">
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

            <!-- Pagination/Empty State -->
            @if($categories->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-folder-open text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-500">No categories found</h3>
                <p class="text-gray-400 mt-1">Create your first category to get started</p>
                <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-2"></i> Add Category
                </button>
            </div>
            @endif
        </div>
    </div>
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold mb-4">Edit Category</h3>
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCategoryId" name="id">
                    <div class="mb-4">
                        <label for="editCategoryName" class="block text-gray-700 mb-2">Category Name</label>
                        <input type="text" id="editCategoryName" name="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Modal Functions
        function openEditModal(id, name) {
            document.getElementById('editCategoryId').value = id;
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Handle form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const categoryId = formData.get('id');

            fetch(`/admin/categories/${categoryId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the name in the table
                        document.getElementById(`category-name-${categoryId}`).textContent = formData.get('name');
                        closeEditModal();
                        // Show success message
                        const successMessage = document.createElement('div');
                        successMessage.className = 'fixed z-50 w-full top-0 right-0 bg-green-500 text-white text-center px-4 py-2 rounded-lg shadow-lg';
                        successMessage.textContent = 'Category updated successfully!';
                        document.body.appendChild(successMessage);

                        // Remove the message after 3 seconds
                        setTimeout(() => {
                            successMessage.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating category');
                });
        });
    </script>

</x-layout>
