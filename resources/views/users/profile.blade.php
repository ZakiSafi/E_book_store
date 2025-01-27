<x-layout>
    <div class="w-full max-w-7xl mx-auto p-8 bg-white p-6 rounded-lg shadow-lg">
        <div class="max-w-xl mx-auto">

            <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

            @if(session('success'))
            <div class="text-green-600 mb-4">{{ session('success') }}</div>
            @endif

            <form action="/users/{{$user->id}}/update" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

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
