<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <x-slot name="heading">Edit Book</x-slot>
    <div class="w-full h-auto flex justify-center items-center p-4 sm:p-6 md:p-8">
        <form action="{{route('user.books.update',$book->id)}}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl bg-white p-4 sm:p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="col-span-1 md:col-span-2">
                    <h2 class="font-semibold text-lg sm:text-xl border-b pb-2">Edit Book Details</h2>
                </div>

                <!-- Title -->
                <div class="flex flex-col">
                    <label for="title" class="font-medium text-gray-700 text-sm sm:text-base">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $book->title) }}"
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
                        value="{{ old('author', $book->author) }}"
                        required
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base" />
                    @error('author')
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
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="flex flex-col">
                    @if ($book->cover_image)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600 mb-1">Current Cover:</p>
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Current cover" class="h-24 w-auto rounded border">
                        <input type="hidden" name="old_cover_image" value="{{ $book->cover_image }}">
                    </div>
                    @endif
                    <label for="image" class="font-medium text-gray-700 text-sm sm:text-base">Update Cover Image</label>
                    <input
                        type="file"
                        id="image"
                        name="cover_image"
                        accept=".jpg,.jpeg,.png"
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm" />
                    <span class="text-gray-400 text-xs sm:text-sm mt-1">.jpg, .jpeg, .png (max 2MB)</span>
                    @error('cover_image')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="flex flex-col col-span-1 md:col-span-2">
                    <label for="description" class="font-medium text-gray-700 text-sm sm:text-base">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-xs sm:text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row justify-start gap-3 sm:gap-4">
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white py-2 px-4 sm:px-6 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm sm:text-base">
                        <i class="fas fa-save mr-1"></i> Update Book
                    </button>
                    <a href="{{ url()->previous() }}"
                        class="bg-gray-500 text-white py-2 px-4 sm:px-6 rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 text-center text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
