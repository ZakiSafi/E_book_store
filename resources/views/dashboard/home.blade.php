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
        <div class=" w-full flex justify-between">
            <p class="text-xl  text-[#888]">Genres</p>
            <a href="/books">
                <span class="text-[#888]">
                    View all books
                </span>
                <i class="fa-solid fa-arrow-up-right-from-square text-sm text-[#888]"></i>
            </a>


        </div>
        <div class="grid grid-cols-3 gap-4 mt-4">
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
            <a href="/categories/6">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Law and Regulations
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
            <a href="/categories/11">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    Data Analytics and Big Data in Finance
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
            <a href="/categories/14">
                <li class="list-none text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white truncate">
                    International Banking
                </li>
            </a>
            <a href="/categories" class="text-gray-500 bg-white p-4 rounded-lg shadow-lg hover:bg-blue-600 hover:text-white ">
                Others
            </a>
        </div>


    </div>
    </div>
    <div class="container w-full mx-auto pt-4 pb-8">
        <h1 class="text-[24px] text-gray-500">Latest Books</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mt-4">
            @foreach ($books as $book)
            <a href="/books/{{$book->id}}" class="group transform transition-transform duration-300 hover:scale-105">
                <div class="bg-white p-2 rounded-lg shadow-lg hover:bg-cyan-200">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                    <h3 class="text-md text-center font-semibold text-gray-800 truncate transition-colors duration-300 group-hover:text-white pt-4">
                        {{$book->title}}
                    </h3>
                </div>
            </a>

            @endforeach

        </div>
    </div>
    <div class="container w-full mx-auto pt-4 pb-8">
        <h1 class="text-[24px] text-gray-500">Most Downloaded</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-6 gap-4 mt-4">
            @foreach ($mostdownloaded as $book)
            @if($book->id && $book->cover_image)
            <a href="/books/{{$book->id}}" class="group transform transition-transform duration-300 hover:scale-105">
                <div class="bg-white p-2 rounded-lg shadow-lg hover:bg-cyan-200">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                    <h3 class="text-md font-semibold text-gray-800 truncate transition-colors duration-300 group-hover:text-white pt-4">
                        {{$book->title}}
                    </h3>
                </div>
            </a>

            @else
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <p class="text-gray-500">No data available for this book</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>


</x-layout>
