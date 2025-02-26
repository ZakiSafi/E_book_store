<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Search Results for "{{ $query }}"</h1>

        @if ($results->isEmpty())
        <p>No results found.</p>
        @else
        @switch($searchType)
        @case('users')
        <h2 class="text-xl font-semibold mb-2">Users</h2>
        <ul>
            @foreach ($results as $user)
            <li class="mb-2">
                <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                    {{ $user->name }} ({{ $user->email }})
                </a>
            </li>
            @endforeach
        </ul>
        @break

        @case('books')
        <h2 class="text-xl font-semibold mb-2">Books</h2>
        <ul>
            @foreach ($results as $book)
            <li class="mb-2">
                <a href="{{ route('books.show', $book->id) }}" class="text-blue-600 hover:text-blue-800">
                    {{ $book->title }} by {{ $book->author }}
                </a>
            </li>
            @endforeach
        </ul>
        @break

        @case('borrowed_books')
        <h2 class="text-xl font-semibold mb-2">Borrowed Books</h2>
        <ul>
            @foreach ($results as $borrowedBook)
            <li class="mb-2">
                <a href="{{ route('borrowed-books.show', $borrowedBook->id) }}" class="text-blue-600 hover:text-blue-800">
                    {{ $borrowedBook->book->title }} (Borrowed by {{ $borrowedBook->user->name }})
                </a>
            </li>
            @endforeach
        </ul>
        @break

        @default
        <p>Invalid search type.</p>
        @endswitch
        @endif
    </div>
</x-layout>
