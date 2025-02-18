<div class="min-h-[35vw] flex items-center justify-center">
    <div class="w-full max-w-[700px] bg-white p-8 rounded-2xl shadow-2xl">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center tracking-wide">📚 Explore Books</h1>
        <form action="{{route('search')}}" method="get" class="space-y-6">
            <!-- Search Field -->
            <div>
                <label for="search" class="block text-md font-semibold text-gray-700">Search Books</label>
                <input
                    type="text"
                    id="search"
                    name="title"
                    placeholder="🔍 Type a book title..."
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-800 shadow-sm transition duration-200 hover:shadow-md" />
            </div>
            <!-- Language & Category -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="language" class="block text-md font-semibold text-gray-700">Language</label>
                    <select
                        id="language"
                        name="language"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-800 shadow-sm transition duration-200 hover:shadow-md">
                        <option>All Languages</option>
                        <option>English</option>
                        <option>Arabic</option>
                        <option>Pashto</option>
                        <option>Urdu</option>
                    </select>
                </div>
                <div>
                    <label for="category" class="block text-md font-semibold text-gray-700">Category</label>
                    <select
                        id="category"
                        name="category_id"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-800 shadow-sm transition duration-200 hover:shadow-md">
                        <option>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Buttons -->
            <div class="flex gap-4">
                <button
                    type="submit"
                    class="flex-1 bg-gradient-to-r from-blue-400 to-blue-500 text-white py-3 px-4 rounded-lg hover:from-blue-500 hover:to-blue-600 transition-all duration-300 font-semibold shadow-md">
                    🔍 Filter
                </button>
                <a
                    href="{{ route('books.index') }}"
                    class="flex-1 bg-gray-300 text-gray-900 py-3 px-4 rounded-lg hover:bg-gray-400 transition-all duration-300 font-semibold shadow-md text-center">
                    🔄 Reset
                </a>
            </div>
        </form>
    </div>
</div>
