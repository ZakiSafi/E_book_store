<x-layout>
    <div class="w-full min-h-screen bg-gray-100 mt-9">
        <!-- PDF Viewer Container -->
        <div class=" w-[calc(100vw-100px)] h-screen mx-auto shadow-lg overflow-hidden rounded-lg">
            <!-- Header Section -->
            <div class="w-full bg-white shadow-md flex flex-row justify-between items-center p-3 sm:p-4 rounded-t-lg">
                <!-- Book Title -->
                <h1 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 truncate max-w-[50%]">
                    {{ $book->title }}
                </h1>

                <!-- Buttons for Larger Screens -->
                <div class="hidden sm:flex gap-2">
                    <a href="{{route('user.books.read.pdf',$book->id)}}" target="_blank"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-md font-semibold px-3 py-1.5 sm:px-4 sm:py-2 rounded-md shadow-md transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                        Open in New Page <i class="fas fa-back"></i>
                    </a>
                    <a href="#" onclick="window.history.back(); return false;"
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
                        <a href="{{route('user.books.read.pdf',$book->id)}}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out">
                            Open in New Page
                        </a>
                        <a href="#" onclick='window.history.back(); return false;'
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white transition duration-300 ease-in-out">
                            Back
                        </a>
                    </div>
                </div>
            </div>



            <!-- PDF Viewer -->
            <iframe src="{{ route('user.books.read.pdf', $book->id) }}" class="w-full h-full overflow-hidden"></iframe>
        </div>

        <!-- Other Books Section -->
        <div class="container w-full max-w-7xl mx-auto p-8">
            <h1 class="text-2xl font-bold text-gray-500">Other Books</h1>
            <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
                @foreach ($books as $book)
                <div class="w-full max-w-[200px]  flex flex-col items-center justify-center transform transition-transform duration-300 hover:scale-105">
                    <a href="{{ route('books.show', $book->id) }}" class="w-full">
                        <div class="w-full flex flex-col  items-center text-center mt-2">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[90%] h-32 md:h-48 object-center rounded-lg mb-2">

                            <h3 class="text-sm font-bold text-gray-800 w-full truncate">{{ Str::limit($book->title, 20) }}</h3>
                            <p class="text-xs font-semibold text-gray-500">{{ $book->author }}</p>
                            <p class="text-xs text-gray-600">{{ $book->language }}</p>
                            <p class="text-[10px] font-medium text-blue-500 bg-blue-100 px-2 py-1 rounded-full mt-1">
                                {{ $book->category->name }}
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>

    </div>

</x-layout>
