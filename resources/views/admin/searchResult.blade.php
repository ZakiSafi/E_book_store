<x-layout>
    <div class="container w-full max-w-7xl p-4 grid grid-cols-1 gap-4 mt-8">
        <!-- Main Content Area -->
        <div class="p-6 rounded-lg shadow-lg bg-white">
            <h1 class="text-3xl font-bold text-gray-800 border-b-2 border-blue-500 pb-2 mb-6">Search Results for "{{ $query }}"</h1>

            @if ($results->isEmpty())
            <p class="text-gray-600">No results found.</p>
            @else
            <!-- Dynamic Styles Based on Search Type -->
            @switch($searchType)
            @case('Users')
            <!-- Users Page Style -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Users</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Books</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookmarks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($results as $user)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 border object-cover rounded-full shrink-0">
                            @else
                            <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="w-24 h-24 border object-cover rounded-full shrink-0">
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.users.books', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $user->Onlinebooks->count() }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->bookmarks->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-4">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fa-solid fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @break
            @case('Online Books')
            <!-- Online Books Page Style -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Online Books</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookmarks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($results as $book)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('books.show', $book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $book->title }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('books.show', $book->id) }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->bookmarks->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap relative">
                            <div class="action-toggle cursor-pointer">
                                <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                            </div>
                            <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                <i class="fa-solid fa-edit text-sm text-blue-600"></i>
                                <a href="{{ route('user.books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-150 ease-in-out">
                                    Edit
                                </a>
                                <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                <form action="{{ route('user.books.destroy', $book->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @break

            @case('Physical Books')
            <!-- Physical Books Page Style -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Physical Books</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Language</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shelf No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available Copies</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($results as $book)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('physicalBooks.show', $book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $book->title }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('physicalBooks.show', $book->id) }}">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            </a>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->author }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->language }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->shelf_no }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-gray-700">{{ $book->available_copies }}</td>
                        <td class="px-6 py-4 whitespace-nowrap relative">
                            <div class="action-toggle cursor-pointer">
                                <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                            </div>
                            <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                <i class="fa-solid fa-edit text-sm text-blue-600"></i>
                                <a href="{{ route('user.books.edit', $book->id) }}" class="text-blue-600 hover:text-blue-800 text-sm transition duration-150 ease-in-out">
                                    Edit
                                </a>
                                <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                <form action="{{ route('admin.physical-books.destroy', $book->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                        Delete
                                    </button>
                                </form>
                                <i class="fa-solid fa-book-open text-sm text-green-600"></i>
                                <a href="{{ route('admin.borrow-books.create', $book->id) }}" class="text-green-600 hover:text-green-800 text-sm transition duration-150 ease-in-out">
                                    Borrow
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @break

            @case('Borrowed Books')
            <!-- Borrowed Books Page Style -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Borrowed Books</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($results as $book)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('books.show', $book->book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $book->book->title }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('physicalBooks.show', $book->book->id) }}">
                                <img src="{{ asset('storage/' . $book->book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            </a>
                        </td>
                        <td class="flex flex-col items-center justify-center gap-y-2 px-6 py-4 whitespace-nowrap text-gray-700">
                            @if ($book->user->profile_picture)
                            <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                            @else
                            <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                            @endif
                            {{ $book->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->borrowed_at->format('Y-m-d')  }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->due_date->format('Y-m-d')  }}</td>
                        <td class="px-6 py-4 whitespace-nowrap relative">
                            <div class="action-toggle cursor-pointer">
                                <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                            </div>
                            <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">

                                <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                <form action="{{route('admin.borrow-books.delete',$book->id)}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                        Delete
                                    </button>
                                </form>


                                <i class="fa-solid fa-check text-sm text-green-600"></i>
                                <form action="{{ route('admin.borrow-books.update', $book->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm transition duration-150 ease-in-out">
                                        Mark as Returned
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @break


            @case('Borrowed Books History')
            <!-- Borrowed Books Page Style -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Borrowed Books History</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Returned At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($results as $book)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out p-2">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('books.show', $book->book->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $book->book->title }}
                            </a>
                        </td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('physicalBooks.show', $book->book->id) }}">
                                <img src="{{ asset('storage/' . $book->book->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            </a>
                        </td>
                        <td class="flex flex-col items-center justify-center gap-y-2 px-6 py-4 whitespace-nowrap text-gray-700">
                            @if ($book->user->profile_picture)
                            <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                            @else
                            <img src="{{ asset('storage/profile_pictures/default.png') }}" alt="Profile Picture" class="popup_profile rounded-full h-20 w-20 shadow-sm hover:shadow-md cursor-pointer">
                            @endif
                            {{ $book->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->borrowed_at->format('Y-m-d')  }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $book->due_date->format('Y-m-d')  }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            {{ $book->returned_at ? $book->returned_at->format('Y-m-d')  : 'Not Returned' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap relative">
                            <div class="action-toggle cursor-pointer">
                                <p class="text-gray-700">action <i class="fa-solid fa-chevron-circle-down text-xs mt-1 text-gray-700"></i></p>
                            </div>

                            <div class="action-sideBar grid grid-cols-[20px,auto] justify-center items-center absolute z-50 right-4 bg-white shadow-md p-2 rounded-md hidden">
                                <i class="fa-solid fa-trash-alt text-sm text-red-600"></i>
                                <form action="{{route('admin.borrow-books.delete',$book->id)}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm transition duration-150 ease-in-out">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <!-- profile picture popup -->
                    <x-profile-popup>
                        <img src="{{ asset('storage/' . $book->user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
                        <h2 class="text-2xl">{{ $book->user->name }}</h2>
                        <p class="mt-2">{{ $book->user->email }}</p>
                    </x-profile-popup>
                    @endforeach
                </tbody>
            </table>
            @break

            @default
            <p class="text-gray-600">Invalid search type.</p>
            @endswitch
            @endif
        </div>
    </div>
</x-layout>