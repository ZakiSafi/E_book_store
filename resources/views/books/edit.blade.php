<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <x-slot name="heading">Edit Book</x-slot>
    <div class="w-full h-auto flex justify-center items-center p-8">
        <form action="{{route('user.books.store',$book->id)}}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="font-semibold text-lg border-b">Edit Book</h2>
                </div>

                <!-- Title -->
                <div class="flex flex-col">
                    <label for="title" class="font-medium text-gray-700">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $book->title) }}"
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
                        value="{{ old('author', $book->author) }}"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('author')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category -->
                <div class="flex flex-col">
                    <label for="category" class="font-medium text-gray-700">Category</label>
                    <select
                        name="category_id"
                        id="category"
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->id }}: {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="flex flex-col">
                    @if ($book->cover_image)
                    <input type="hidden" name="old_cover_image" value="{{ $book->cover_image }}">
                    @endif
                    <label for="image" class="font-medium text-gray-700">Choose Image</label>
                    <input
                        type="file"
                        id="image"
                        name="cover_image"
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('cover_image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col col-span-2">
                    <label for="description" class="font-medium text-gray-700">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="h-36 text-sm mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex justify-start gap-4">
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Update
                    </button>
                    <a href="#" onclick="window.history.back()"
                        class="bg-indigo-600 text-white py-2 px-6 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
