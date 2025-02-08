<x-layout>
    <div class="relative">
        <img src="{{ asset('images/library.jpg') }}" alt="cover" class="w-full h-96  object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white bg-black bg-opacity-50">
            <h1 class="text-4xl font-bold mb-4">BMA Library</h1>
            <form action="/search" method="GET" class="w-full max-w-md">
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

            <p class="text-xl  text-[#888]">Genres</p>
            <a href="/books">
                <span class="text-[#888]">
                    View all books
                </span>
                <i class="fa-solid fa-arrow-up-right-from-square text-sm text-[#888]"></i>
            </a>


        </div>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <a href="/categories/1">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Management and Leadership
                </li>
            </a>

            <a href="/categories/2">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Investment and Stock Market
                </li>
            </a>
            <a href="/categories/3">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Islamic Banking and Finance
                </li>
            </a>
            <a href="/categories/4">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Banking and Finance
                </li>
            </a>
            <a href="/categories/5">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Financial Analysis and Planning
                </li>
            </a>
            <a href="/categories/7">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Risk Management
                </li>
            </a>
            <a href="/categories/8">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Marketing and Sales
                </li>
            </a>
            <a href="/categories/9">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Microfinance and Rural Banking
                </li>
            </a>
            <a href="/categories/10">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Human Resource Management
                </li>
            </a>

            <a href="/categories/12">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Economics
                </li>
            </a>
            <a href="/categories/13">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Fraud Detection and Prevention
                </li>
            </a>
            <a href="/books" class="text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white ">
                Others
            </a>
        </div>


    </div>

    <div class="container w-full  mx-auto pt-4 pb-8">
        <h1 class="text-[24px] text-gray-500">Latest Books</h1>
        <div class="grid grid-cols-2 md:grid-cols-3  lg:grid-cols-4 gap-4 mt-4">
            @foreach ($books as $book)
            <a href="/books/{{$book->id}}" class="group transform transition-transform duration-300 hover:scale-105 mb-4">
                <div class="flex flex-col justify-center items-center">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[70%] h-32 md:h-48 object-center rounded-lg">
                    <h3 class="text-md text-center font-semibold text-blue-400 transition-colors duration-300  pt-4">
                        {{Str::limit($book->title,20)}}
                    </h3>
                    <p class="text-sm font-semibold text-gray-800">{{Str::limit($book->author,20)}}</p>
                </div>
            </a>

            @endforeach

        </div>
    </div>
    <div class="container w-full mx-auto pt-4 pb-8">
        <h1 class="text-[24px] text-gray-500">Most Downloaded</h1>
        <div class="grid grid-cols-2 md:grid-cols-3  lg:grid-cols-4 gap-4 mt-4">
            @foreach ($mostdownloaded as $book)
            @if($book->id && $book->cover_image)
            <a href="/books/{{$book->id}}" class="group transform transition-transform duration-300 hover:scale-105 mb-4">
                <div class="flex flex-col justify-center items-center">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[70%] h-32 md:h-48 object-center rounded-lg">
                    <h3 class="text-md text-center font-semibold text-blue-400 transition-colors duration-300  pt-4">
                        {{Str::limit($book->title,20)}}
                    </h3>
                    <p class="text-sm font-semibold text-gray-800">{{Str::limit($book->author,20)}}</p>
                </div>
            </a>

            @else
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <p class="text-gray-500">No Books downloaded yet</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>


</x-layout>