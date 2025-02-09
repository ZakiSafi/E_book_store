<x-layout>
    <x-slot name="heading">Create Book</x-slot>
    <div class="w-full h-auto flex justify-center items-center p-8">
        <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="font-semibold text-lg border-b">Add Book</h2>
                </div>
                <!-- Title -->
                <div class="flex flex-col">
                    <label for="title" class="font-medium text-gray-700">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Author -->
                <div class="flex flex-col">
                    <label for="author" class="font-medium text-gray-700">Author</label>
                    <input
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author') }}"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label for="language" class="font-medium text-gray-700">Language</label>
                    <select
                        name="language"
                        id="language"
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <!-- Example languages (replace with your actual options) -->
                        <option value="">Select a Language</option>
                        <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                        <option value="pashto" {{ old('language') == 'pashto' ? 'selected' : '' }}>Pashto</option>
                        <option value="dari" {{ old('language') == 'dari' ? 'selected' : '' }}>Dari</option>
                        <option value="dari" {{ old('language') == 'urdu' ? 'selected' : '' }}>Urdu</option>
                        <!-- Add more languages here -->
                    </select>
                    @error('language')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="category" class="font-medium text-gray-700">Category</label>
                    <select
                        name="category_id"
                        id="category"
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->id }}: {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="flex flex-col">
                    <label for="image" class="font-medium text-gray-700">Choose Image</label>
                    <input
                        type="file"
                        id="image"
                        name="cover_image"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    <span class="text-gray-400">.jpg, .jpeg, .png file types are allowed.</span>

                    @error('cover_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Book file -->
                <div class="flex flex-col">
                    <label for="image" class="font-medium text-gray-700">Choose Book</label>
                    <input
                        type="file"
                        id="book_file"
                        name="book_file"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    <span class="text-gray-400">.pdf file type is allowed</span>
                    @error('book_file')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="description" class="font-medium text-gray-700">Edition</label>
                    <input
                        type="text"
                        id="edition"
                        placeholder="optional"
                        name="edition"
                        class="text-sm mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </input>
                    @error('edition')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="description" class="font-medium text-gray-700">Release Date</label>
                    <input
                        type="date"
                        id="date"
                        name="release_date"
                        class="text-sm mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </input>
                    @error('release_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col col-span-2">
                    <label for="description" class="font-medium text-gray-700">Description</label>
                    <textarea
                        type="text"
                        id="description"
                        name="description"
                        class=" h-36 text-sm mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </textarea>
                </div>


                <!-- Submit Button -->
                <div class="col-span-2 flex justify-start gap-4">
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Save
                    </button>
                    <a href="/users"
                        type="text"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
