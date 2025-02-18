<x-layout>
    <x-session />
    <div class="w-full grid justify-center items-center p-8">
        <form action="{{ route('user.books.store') }}" method="POST" enctype="multipart/form-data" class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <!-- Grid container with responsive columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full-width heading -->
                <div class="col-span-1 md:col-span-2">
                    <h2 class="text-lg font-semibold border-b pb-2">Add Book</h2>
                </div>

                <!-- Form inputs -->
                <x-form.input label="Title" name="title" required />
                <x-form.input label="Author" name="author" required />
                <x-form.input label="Translator" placeholder="optional" name="translator" />
                <x-form.input label="Publication Year" name="publication_year" type="number" min="1000" max="{{ date('Y') }}" />
                <x-form.input label="Printing House" name="printing_house" />
                <x-form.input label="Edition" name="edition" />
                <x-form.input label="Shelf No" name="shelf_no" require />
                <x-form.input label="Copies" name="copies" type="number" required min="1" />

                <!-- Language dropdown -->
                <div class="flex flex-col">
                    <label for="language" class="font-medium text-gray-700">Language</label>
                    <select name="language" id="language" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500">
                        <option value="">Select a Language</option>
                        <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                        <option value="pashto" {{ old('language') == 'pashto' ? 'selected' : '' }}>Pashto</option>
                        <option value="dari" {{ old('language') == 'dari' ? 'selected' : '' }}>Dari</option>
                        <option value="urdu" {{ old('language') == 'urdu' ? 'selected' : '' }}>Urdu</option>
                    </select>
                    @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Category dropdown -->
                <div class="flex flex-col">
                    <label for="category" class="font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Cover image upload -->
                <div class="flex flex-col">
                    <label for="cover_image" class="font-medium text-gray-700">Cover Image</label>
                    <input type="file" id="cover_image" name="cover_image" class="mt-1 border p-2 rounded-md shadow-sm focus:ring focus:border-indigo-500" />
                    <span class="text-gray-400 text-sm">.jpg, .jpeg, .png file types allowed.</span>
                    @error('cover_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description textarea -->
                <div class="col-span-1 md:col-span-2 flex flex-col">
                    <label for="description" class="font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" class="mt-1 border rounded-md p-2 min-h-32 shadow-sm focus:ring focus:border-indigo-500"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Buttons -->
                <div class="col-span-1 md:col-span-2 flex justify-start gap-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                    <a href="#" onclick="window.history.back(); return false;" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>