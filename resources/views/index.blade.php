<x-layout>
    <!-- Loading Screen -->
    <div id="remove-loader">
        <div id="load_screen" class="fixed inset-0 z-[999999] bg-[#ecefff]">
            <div class="flex justify-center h-screen">
                <div class="self-center text-center">
                    <!-- Spinner -->
                    <div class="spinner">
                        <div class="double-bounce1 bg-[#304aca]"></div>
                        <div class="double-bounce2 bg-[#304aca]"></div>
                    </div>
                    <!-- Loading Text -->
                    <h1 class="text-2xl font-bold text-[#304aca] mt-4">Loading...</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <div class="relative">
        <img src="{{ asset('images/library.jpg') }}" alt="cover" class="w-full h-[40vw]  object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white bg-black bg-opacity-50">
            <h1 class="text-4xl font-bold mb-4">BMA Library</h1>
            <form action="{{route('search')}}" method="GET" class="w-full max-w-md">
                <div class="flex justify-between bg-white rounded-full shadow-md">
                    <input type="text" name="title" placeholder="Search for books..." class="w-full py-2 px-4 rounded-l-full focus:outline-none text-black">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 hover:font-semibold text-white py-2 px-4 rounded-r-full
                    ">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="container w-full mx-auto pt-8 pb-8">
        <div class=" w-full flex justify-between p-4">

            <p class="text-xl  text-gray-400">Categories</p>
            <a href="{{route('books.index')}}" class="group">
                <span class="text-[#888]  transition transition-all duration-300 group-hover:text-gray-700">
                    View all books
                </span>
                <i class="fa-solid fa-arrow-up-right-from-square hover:group text-sm text-[#888] group-hover:text-gray-700"></i>
            </a>


        </div>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($categories as $cat )
            <a href="{{route('user.categories.show',['category' => $cat->id])}}">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    {{ $cat->name }}
                </li>
            </a>

            @endforeach
            <a href="/books" class="text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white ">
                Others
            </a>
        </div>


    </div>

    <div class="container w-full max-w-7xl mx-auto p-8">
        <h1 class="text-[24px] text-gray-500">Latest Books</h1>
        <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
            @if ($books->isEmpty())
            <div class="w-full col-span-4 bg-white rounded-lg shadow-lg p-6 text-center">
                <h1 class="text-lg font-bold text-red-500">No books found!</h1>
            </div>
            @else
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
            @endif
        </div>
    </div>
    <div class="container w-full max-w-7xl mx-auto p-8">
        <h1 class="text-[24px] text-gray-500">Most Downloaded</h1>
        <div class="w-full mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center p-8">
            @if ($mostdownloaded->isEmpty())
            <div class="w-full col-span-4 bg-white rounded-lg shadow-lg p-6 text-center">
                <h1 class="text-lg font-bold text-red-500">No Books downloaded yet!</h1>
            </div>
            @else
            @foreach ($mostdownloaded as $book)
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
            @endif
        </div>
    </div>


</x-layout>
