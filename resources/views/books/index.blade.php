<!-- filepath: resources/views/books/index.blade.php -->
<x-layout>
    <div class="min-h-[500px] flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-[700px] bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Books</h1>
            <form action="/search" method="get" class="space-y-4">
                <!-- Search Field -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search Books</label>
                    <input
                        type="text"
                        id="search"
                        name="title"
                        placeholder="Search ..."
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-gray-800" />
                </div>
                <!-- Language Dropdown -->
                <div class="grid grid-cols-2 gap-2">

                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                        <select
                            id="language"
                            name="language"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-gray-800">
                            <option>All Languages</option>
                            <option>English</option>
                            <option>Arabic</option>
                            <option>Pashto</option>
                        </select>
                    </div>
                    <!-- Category Field -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select
                            id="category"
                            name="category_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-gray-800">
                            <option value="">Select Category</option>
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
                        class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none text-sm font-medium">
                        Filter
                    </button>
                    <button
                        type="reset"
                        class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 text-sm font-medium">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="container mx-auto mb-10 max-w-3xl">
        <h1 class="text-2xl font-bold mb-4">Books</h1>
        <div class="grid grid-cols-3 gap-8">
            @foreach ($books as $book)
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $book->title }}</h3>
                <a href="books/{{$book->id}}" class="text-white text-center bg-blue-500 shadow-sm mt-4 px-4 py-1 rounded-lg   transition transition-transform hover:scale-105 duration-300 w-full inline-block">View Details</a>


            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</x-layout>
