<x-layout>
    <div class="bg-white shadow-lg">{{ $totalBooks }}</div>
    @foreach ($physicalBooks as $book )
    <div class="bg-green-500">
        <h1>{{ $book->title }}</h1>
        <p>{{ $book->author }}</p>
        <p>{{ $book->avalible_copies }}</p>

    </div>

    @endforeach
</x-layout>
