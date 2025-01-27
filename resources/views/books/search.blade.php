<x-layout>
    <div class="min-h-[500px] flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-[700px] bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Books</h2>
            <form action="/search" class="space-y-4">
                <!-- Search Field -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Search (Optional)</label>
                    <input
                        type="text"
                        id="search"
                        name='title'
                        placeholder="Search ..."
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 text-gray-800" />
                </div>
                <!-- Language Dropdown -->
                <div>
                    <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                    <select
                        id="language"
                        name='language'
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
                <!-- Buttons -->
                <div class="flex gap-4">
                    <button
                        type="submit"
                        class="flex-1 bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm font-medium">
                        Search
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
    <div class="w-full max-w-[700px] mx-auto bg-white rounded-lg shadow-lg mb-2 p-2">
        <h1 class="pb-2 font-bold text-xl  ">Search result for "{{ $searchQuery }}"</h1>
    </div>
    @if ($books->isEmpty())
    <div class="w-full max-w-[700px] mx-auto bg-white rounded-lg shadow-lg p-2 mb-2">
        <h1 class="pb-2 font-bold text-xl text-red-500  ">No books found!</h1>
    </div>
    @else
    <div class="container w-full max-w-7xl grid items-center justify-center pt-2 pb-8">
        <div class="w-full max-w-[700px] bg-white p-6 rounded-lg shadow-lg">
            @foreach ($books as $book)
            <div class="grid grid-cols-2 mb-8 items-center">
                <div class="rounded-lg overflow-hidden h-48 w-30 rounded-lg">
                    <a href="/books/{{$book->id}}">

                        <img
                            src="{{ asset('storage/' . $book->cover_image) }}"
                            alt="{{ $book->title }}"
                            class="object-cover w-72 h-72 rounded-lg " />
                    </a>
                </div>
                <div class="self-start flex flex-col gap-2">
                    <h3 class="text-xl font-bold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-md font-semi-bold text-gray-400">{{ $book->author }}</p>
                    <p class="text-md text-gray-600">{{ $book->language }}</p>
                    <p class="text-md text-gray-600">{{ $book->category->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</x-layout>
