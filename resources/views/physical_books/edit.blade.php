<x-layout>
    <div class="w-full grid justify-center items-center p-8">
        <form action="{{ route('admin.physical-books.update',$book->id) }}" method="put" enctype="multipart/form-data" class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <h2 class="text-lg font-semibold border-b pb-2">Edit Book</h2>
                </div>

                <x-form.input label="Title" name="title" value="{{old('title',$book->title)}}" required />
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Author" name="author" value="{{old('author',$book->author)}}" required />
                @error('author') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Translator" placeholder="optional" name="translator" value="{{old('translator',$book->translator)}}" />
                @error('translator') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Publication Year" name="publication_year" type="number" min="1000" max="{{ date('Y') }}" value="{{old('publication_year',$book->publication_year)}}" required />
                @error('publication_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Printing House" name="printing_house" value="{{old('printing_house',$book->printing_house)}}" required />
                @error('printing_house') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Edition" name="edition" value="{{old('edition',$book->edition)}}" required />
                @error('edition') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Shelf No" name="shelf_no" value="{{old('shelf_no',$book->shelf_no)}}" required />
                @error('shelf_no') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-form.input label="Copies" name="copies" type="number" value="{{old('copies',$book->copies)}}" required min="1" />
                @error('copies') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="flex flex-col">
                    <label for="language" class="font-medium text-gray-700">Language</label>
                    <select name="language" id="language" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500">
                        <option value="english" {{ old('language', $book->language) == 'english' ? 'selected' : '' }}>English</option>
                        <option value="pashto" {{ old('language', $book->language) == 'pashto' ? 'selected' : '' }}>Pashto</option>
                        <option value="dari" {{ old('language', $book->language) == 'dari' ? 'selected' : '' }}>Dari</option>
                        <option value="urdu" {{ old('language', $book->language) == 'urdu' ? 'selected' : '' }}>Urdu</option>
                        <option value="arabic" {{ old('language', $book->language) == 'arabic' ? 'selected' : '' }}>Urdu</option>

                    </select>
                    @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="flex flex-col">
                    <label for="category" class="font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category" required class="mt-1 border rounded-md p-2 shadow-sm focus:ring focus:border-indigo-500">
                        @foreach($categories as $category)
                        <option value="{{old('category_id',$book->category_id)}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="flex flex-col">
                    @if ($book->cover_image)
                    <input type="hidden" name="old_cover_image" value="$book->cover_image">
                    @endif

                    <label for="cover_image" class="font-medium text-gray-700">Cover Image</label>
                    <input type="file" id="cover_image" name="cover_image" class="mt-1 border p-2 rounded-md shadow-sm focus:ring focus:border-indigo-500" required />
                    <span class="text-gray-400 text-sm">.jpg, .jpeg, .png file types allowed.</span>
                    @error('cover_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


                <div class="col-span-1 md:col-span-2 flex flex-col">
                    <label for="description" class="font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" class="mt-1 border rounded-md p-2 min-h-32 shadow-sm focus:ring focus:border-indigo-500"> {{old('description',$book->description)}}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>


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
