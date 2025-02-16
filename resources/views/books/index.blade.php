<!-- filepath: resources/views/books/index.blade.php -->
<x-layout>
    <!-- session success message -->
    <x-session />
    <!-- main content -->
    <div class="min-h-[500px] flex items-center justify-center bg-gray-100">
        
    </div>
    <div class="container w-full mx-auto pt-4 pb-8">
        <h1 class="text-3xl font-bold text-gray-800">Books</h1>
        <div class="grid grid-cols-3  lg:grid-cols-4 gap-4 mt-4">
            @foreach ($books as $book)
            <a href="{{route('user.books.show',$book->id)}}" class="group transform transition-transform duration-300 hover:scale-105 mb-4">
                <div class="flex flex-col justify-center items-center">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-[70%] h-48 object-cover rounded-lg">
                    <h3 class="text-md text-center font-semibold text-blue-400 transition-colors duration-300  pt-4">
                        {{Str::limit($book->title,20)}}
                    </h3>
                    <p class="text-sm font-semibold text-gray-800">{{Str::limit($book->author,20)}}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</x-layout>
