<x-layout>
    <div class="container w-full max-w-7xl mx-auto grid grid-cols-3 gap-4 p-12 rounded-lg shadow-lg">
        <div class="flex flex-col gap-3 h-64 w-64 text-[#666] bg-white rounded-lg text-lg col-span-1   shadow-lg p-4">
            @auth
            @if (Auth::user()->role == 'user')
            <a href="/dashboard" class="group flex items-center" aria-label="Go to Dashboard">
                <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
            </a>
            <a href="/user/books" class="group flex items-center" aria-label="Manage Books">
                <i class="fa-solid fa-book text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
            </a>
            <a href="/bookmarks" class="group flex items-center" aria-label="View Bookmarks">
                <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
            </a>
            @else
            <a href="/admin/dashboard" class="group flex items-center" aria-label="Go to Dashboard">
                <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
            </a>
            <a href="/admin/books" class="group flex items-center" aria-label="Manage Books">
                <i class="fa-solid fa-book text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
            </a>
            <a href="/admin/bookmarks" class="group flex items-center" aria-label="View Bookmarks">
                <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
            </a>
            @endif
            @endauth
            <a href="/profile" class="group flex items-center" aria-label="Edit Profile">
                <i class="fa-solid fa-user text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
            </a>

        </div>

        <div class="max-w-xl  col-span-2 self-start">

            <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

            @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
            @endif

            <form action="/profile/{{$user->id}}/update" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

                @csrf
                @method('PATCH')

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Profile Picture Field -->
                <div class="mb-4">
                    <label for="profile_picture" class="block text-gray-700 font-semibold mb-2">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="w-full p-2 border border-gray-300 rounded-lg">
                    @error('profile_picture')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-[14px] hover:bg-blue-600 hover:text-[16px] text-white  px-2 py-2 rounded-lg">Update Profile</button>
            </form>
        </div>

    </div>
</x-layout>
