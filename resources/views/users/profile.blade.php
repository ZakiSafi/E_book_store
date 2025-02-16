<x-layout>
    <!-- session success message -->
        <x-session />
    <!-- main content -->
    <div class="container w-full max-w-7xl mx-auto grid grid-cols-3 gap-4 p-12 rounded-lg shadow-lg">
        <x-sideBar />

        <div class="max-w-xl  col-span-2 self-start">

            <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>


            <form action="{{route('user.profile.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">

                @csrf
                @method('PATCH')

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

                <button type="submit" class="bg-blue-500 text-md hover:bg-blue-600 text-white  px-2 py-2 rounded-lg">Update Profile</button>
            </form>
        </div>

    </div>
</x-layout>
