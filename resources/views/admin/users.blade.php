<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-4 gap-4 mt-8">
        <!-- Sidebar Navigation -->
        <x-adminSidebar />

        <!-- Main Content Area -->
        <div class="p-4 rounded-lg shadow-lg col-span-3">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold mb-4 border-b-2">Manage Users</h2>
                Total Users :{{ $totalUsers }}
            </div>

            <!-- Books Table Section -->
            <div class="mt-8 mb-2">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Image</th>
                            <th class="px-4 py-2 text-left">Books</th>
                            <th class="px-4 py-2 text-left">Bookmarks</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{$user->email }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Cover Image" class="w-24 h-24 border object-cover rounded-full shrink-0 ">
                            </td>

                            <td class="px-4 py-2">
                                <a href="{{route('admin.users.books',$user->id)}}">
                                    {{ $user->Onlinebooks->count() }}
                                </a>
                            </td>
                            <td class="px-4 py-2">{{$user->bookmarks->count()}}</td>

                            <td class="px-4 py-2 flex space-x-4">
                                <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" class="inline-block">
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
            </div>
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
