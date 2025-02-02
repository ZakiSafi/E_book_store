<x-layout>
    <div class="w-full min-h-screen bg-gray-100 mt-9">
        <!-- PDF Viewer Container -->
        <div class=" w-[calc(100vw-100px)] h-screen md:h-[calc(100vh-100px)] sm:h-[calc(100vh-150px)] mx-auto shadow-lg overflow-hidden rounded-lg">
            <!-- Header Section -->
            <div class="w-full bg-white shadow-md flex flex-row justify-between items-center p-3 sm:p-4 rounded-t-lg">
                <!-- Book Title -->
                <h1 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 truncate max-w-[50%]">
                    {{ $book->title }}
                </h1>

                <!-- Buttons for Larger Screens -->
                <div class="hidden sm:flex gap-2">
                    <a href="{{route('books.read.pdf',$book->id)}}"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-md font-semibold px-3 py-1.5 sm:px-4 sm:py-2 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                        Open in new page <i class="fas fa-back"></i>
                    </a>
                    <a href="/books/{{$book->id}}"
                        class="bg-red-500 hover:bg-red-600 text-white text-sm sm:text-md font-semibold px-3 py-1.5 sm:px-4 sm:py-2 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                        Back <i class="fas fa-back"></i>
                    </a>
                </div>

                <!-- Dropdown for Small Screens -->
                <div class="sm:hidden relative">
                    <!-- Dropdown Toggle Button -->
                    <button id="dropdown-toggle" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-ellipsis-v"></i> <!-- Icon for dropdown -->
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="{{route('books.read.pdf',$book->id)}}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out">
                            Open in new page
                        </a>
                        <a href="/books/{{$book->id}}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white transition duration-300 ease-in-out">
                            Back
                        </a>
                    </div>
                </div>
            </div>



            <!-- PDF Viewer -->
            <iframe src="{{ route('books.read.pdf', $book->id) }}" class="w-full h-full overflow-hidden"></iframe>
        </div>

        <!-- Other Books Section -->
        <div class="w-full lg:w-[calc(100vw-90px)] mx-auto mt-8">
            <h1 class="text-2xl font-semibold text-gray-800">Other Books</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                @foreach ($books as $book)
                <a href="/books/{{$book->id}}" class="group transform transition-transform duration-300 hover:scale-105 mb-4">
                    <div class="flex flex-col justify-center items-center">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[70%] h-48 object-cover rounded-lg">
                        <h3 class="text-md text-center font-semibold text-blue-400 transition-colors duration-300 pt-4">
                            {{ Str::limit($book->title, 20) }}
                        </h3>
                        <p class="text-sm font-semibold text-gray-800">{{ Str::limit($book->author, 20) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- JavaScript to Toggle Dropdown -->
    <script>
        document.getElementById('dropdown-toggle').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownToggle = document.getElementById('dropdown-toggle');
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</x-layout>
