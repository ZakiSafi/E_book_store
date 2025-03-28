<x-layout>
    <div class="w-full grid justify-center items-center p-4 sm:p-6 md:p-8">
        <form action="{{ route('admin.physical-books.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-4xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="col-span-1 md:col-span-2">
                    <h2 class="text-lg sm:text-xl font-semibold border-b pb-2">Add Physical Book</h2>
                </div>

                <!-- Book Information -->
                <x-form.input label="Book Name" name="title" value="{{old('title')}}" required class="w-full" />
                <x-form.input label="Author" name="author" value="{{old('author')}}" required class="w-full" />
                <x-form.input label="Translator" placeholder="optional" name="translator" value="{{old('translator')}}" class="w-full" />
                <x-form.input label="Publication Year" name="publication_year" type="number" min="1000" max="{{ date('Y') }}" value="{{old('publication_year')}}" required class="w-full" />
                <x-form.input label="Printing House" name="printing_house" value="{{old('printing_house')}}" required class="w-full" />
                @error('printing_house') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror

                <!-- Book Details -->
                <x-form.input label="Edition" name="edition" value="{{old('edition')}}" class="w-full" />
                @error('edition') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                <x-form.input label="Shelf No" name="shelf_no" value="{{old('shelf_no')}}" required class="w-full" />
                @error('shelf_no') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                <x-form.input label="Copies" name="copies" type="number" value="{{old('copies')}}" required min="1" class="w-full" />
                @error('copies') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror

                <!-- Language Select -->
                <div class="flex flex-col">
                    <label for="language" class="font-medium text-gray-700 text-sm sm:text-base">Language</label>
                    <select name="language" id="language" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500 text-sm sm:text-base">
                        <option value="">Select a Language</option>
                        <option value="english" {{ old('language') == 'english' ? 'selected' : '' }}>English</option>
                        <option value="pashto" {{ old('language') == 'pashto' ? 'selected' : '' }}>Pashto</option>
                        <option value="dari" {{ old('language') == 'dari' ? 'selected' : '' }}>Dari</option>
                        <option value="urdu" {{ old('language') == 'urdu' ? 'selected' : '' }}>Urdu</option>
                    </select>
                    @error('language') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Category Select -->
                <div class="flex flex-col">
                    <label for="category" class="font-medium text-gray-700 text-sm sm:text-base">Category</label>
                    <select name="category_id" id="category" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500 text-sm sm:text-base">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Cover Image Upload -->
                <div class="flex flex-col">
                    <label for="cover_image" class="font-medium text-gray-700 text-sm sm:text-base">Cover Image</label>
                    <input type="file" id="cover_image" name="cover_image" class="mt-1 border p-2 rounded-md shadow-sm focus:ring focus:border-indigo-500 text-xs sm:text-sm" required />
                    <span class="text-gray-400 text-xs sm:text-sm">.jpg, .jpeg, .png file types allowed (max 2MB)</span>
                    @error('cover_image') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="col-span-1 md:col-span-2 flex flex-col">
                    <label for="description" class="font-medium text-gray-700 text-sm sm:text-base">Description</label>
                    <textarea id="description" name="description" class="mt-1 border rounded-md p-2 min-h-32 shadow-sm focus:ring focus:border-indigo-500 text-sm sm:text-base">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Form Actions -->
                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row justify-start gap-3 sm:gap-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 sm:px-6 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                    <a href="#" onclick="window.history.back(); return false;" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300 text-center text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
