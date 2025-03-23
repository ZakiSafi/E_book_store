<x-layout>
    <!-- session success message -->
    <x-session />

    <!-- main content -->
    <div class="container max-w-7xl mx-auto gap-4  rounded-lg shadow-lg grid grid-cols-[120px,auto] items-center ">
        <!-- side bar -->
        @auth
        @if (Auth::user()->role == 'admin')
        <x-admin-sidebar :user="Auth::user()" />

        @elseif (Auth::user()->role == 'user')
        <x-user-sidebar :user="Auth::user()" />

        @endif
        @endauth


        <div class="max-w-xl  ml-64">

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
