<x-layout>
    <x-slot name="heading">Edit</x-slot>
    <form action="/books/{{$book->id}}" method="POST" enctype="multipart/form-data">
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
        <x-form.field>
            <x-form.label for="title">Title</x-form.label>
            <x-form.input
                type="text"
                id="title"
                name="title"
                value="{{ $book->title }}"
                required />
            <x-form.error name='title'></x-form.error>
        </x-form.field>
        <x-form.field>
            <x-form.label for="author">Author</x-form.label>
            <x-form.input
                type="text"
                id="author"
                name="author"
                value="{{ $book->author }}"
                required />
            <x-form.error name='author'></x-form.error>
        </x-form.field>
        <x-form.field>
            <x-form.label for="price">Price</x-form.label>
            <x-form.input
                type="text"
                id="price"
                name="price"
                value='{{$book->price}}' />
            <x-form.error name='price'></x-form.error>
        </x-form.field>

        <x-form.field>
            <x-form.label for="description">Description</x-form.label>

            <x-form.input
                type="text"
                id="description"
                name=" description"
                required
                value="{{$book->description}}" />
            <x-form.error name='description'></x-form.error>
        </x-form.field>
        <x-form.field>
            <x-form.label for="category">Category</x-form.label>
            <select
                name="category_id"
                id="category"
                required
                class="mt-1 block w-1/2 h-1/4 rounded-md border border-gray-300 bg-white px-2 py-1 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-form.error name='category'></x-form.error>
        </x-form.field>
        <x-form.field>
            <x-form.label for="image">Choose Image</x-form.label>
            <x-form.input
                type="file"
                id="image"
                name="cover_image"
                required />
            <x-form.error name='description'></x-form.error>
        </x-form.field>


        <x-form.button>Update</x-form.button>
    </form>
    <a href="/books">Back</a>
</x-layout>
