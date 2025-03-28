<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <div class="w-full h-auto flex justify-center items-center p-4 sm:p-6 md:p-8">
        <form action="{{route('user.books.store')}}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl grid grid-cols-1 md:grid-cols-2 bg-white p-4 sm:p-6 rounded-lg shadow-md gap-4 sm:gap-6">
            @csrf
            <div class="col-span-1 md:col-span-2">
                <h2 class="font-semibold text-lg sm:text-xl border-b pb-2">Add Digital Book</h2>
            </div>

            <!-- Title -->
            <div class="flex flex-col">
                <label for="title" class="font-medium text-gray-700 text-sm sm:text-base">Book Name</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base" />
                @error('title')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Author -->
            <div class="flex flex-col">
                <label for="author" class="font-medium text-gray-700 text-sm sm:text-base">Author</label>
                <input
                    type="text"
                    id="author"
                    name="author"
                    value="{{ old('author') }}"
                    required
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base" />
                @error('author')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Language -->
            <div class="flex flex-col">
                <label for="language" class="font-medium text-gray-700 text-sm sm:text-base">Language</label>
                <select
                    name="language"
                    id="language"
                    required
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base">
                    <option value="">Select a Language</option>
                    <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                    <option value="pashto" {{ old('language') == 'pashto' ? 'selected' : '' }}>Pashto</option>
                    <option value="dari" {{ old('language') == 'dari' ? 'selected' : '' }}>Dari</option>
                    <option value="urdu" {{ old('language') == 'urdu' ? 'selected' : '' }}>Urdu</option>
                </select>
                @error('language')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="flex flex-col">
                <label for="category" class="font-medium text-gray-700 text-sm sm:text-base">Category</label>
                <select
                    name="category_id"
                    id="category"
                    required
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Cover Image -->
            <div class="flex flex-col">
                <label for="image" class="font-medium text-gray-700 text-sm sm:text-base">Cover Image</label>
                <input
                    type="file"
                    id="image"
                    name="cover_image"
                    accept=".jpg,.jpeg,.png"
                    required
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm" />
                <span class="text-gray-400 text-xs sm:text-sm">.jpg, .jpeg, .png (max 2MB)</span>
                @error('cover_image')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Book file -->
            <div class="flex flex-col">
                <label for="book_file" class="font-medium text-gray-700 text-sm sm:text-base">Book File</label>
                <input
                    type="file"
                    id="book_file"
                    name="book_file"
                    accept=".pdf"
                    required
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm" />
                <span class="text-gray-400 text-xs sm:text-sm">PDF only (max 10MB)</span>
                @error('book_file')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Edition -->
            <div class="flex flex-col">
                <label for="edition" class="font-medium text-gray-700 text-sm sm:text-base">Edition (optional)</label>
                <input
                    type="text"
                    id="edition"
                    name="edition"
                    value="{{ old('edition') }}"
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base" />
                @error('edition')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Release Date -->
            <div class="flex flex-col">
                <label for="date" class="font-medium text-gray-700 text-sm sm:text-base">Release Date</label>
                <input
                    type="date"
                    id="date"
                    name="release_date"
                    value="{{ old('release_date') }}"
                    class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base" />
                @error('release_date')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="flex flex-col col-span-1 md:col-span-2">
                <label for="description" class="font-medium text-gray-700 text-sm sm:text-base">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="h-32 sm:h-36 mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base">{{ old('description') }}</textarea>
                @error('description')
                <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row justify-start gap-3 sm:gap-4">
                <button
                    type="submit"
                    class="bg-blue-500 text-white py-2 px-4 sm:px-6 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
                <a href="#" onclick="window.history.back(); return false;" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300 text-center text-sm sm:text-base">
                    <i class="fas fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </form>
    </div>
</x-layout>
