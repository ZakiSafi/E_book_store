<x-layout>
    <div class="container w-full max-w-7xl p-8 grid grid-cols-3  gap-4 mt-8">

        <!-- First div: spans first and second rows -->
        <div class=" p-4 rounded-lg shadow-lg col-span-1">
            <div class="flex flex-col gap-3 text-[#666] text-lg">
                <a href="/users" class="group">
                    <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
                </a>

                <a href="/user/books" class="group">
                    <i class="fa-solid fa-book text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
                </a>
                <a href="/users/{{$user->id}}/profile" class="group">
                    <i class="fa-solid fa-user text-[#666] mr-2"></i>
                    <span class="group-hover:border-b group-hover:border-black">Edit profile</span>
                </a>
            </div>

        </div>

        <!-- Second div: spans second and third columns -->
        <div class=" p-4 rounded-lg shadow-lg col-span-2">
            <h2 class="text-2xl font-bold mb-4 border-b-2">Dashboard</h2>

            <div class="flex gap-4">
                <div>
                    @if ($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-full h-24 w-24 cursor-pointer" onclick="openProfileModal()">

                    @else
                    <img src=" {{ asset('storage/profile_pictures/default.jfif') }}" alt="Default Profile Picture" class="rounded-full h-24 w-24">
                    @endif
                </div>
                <div>
                    <p class="text-gray-700"><span class="inline-block text-md font-semibold">Hello</span>, {{$user->name}}</p>
                    <p class="text-gray-700">Welcome to your dashboard</p>
                    <p class="text-gray-500">
                        Last Login:
                        @if ($lastLoginDate)
                        {{ $lastLoginDate->diffForHumans() }}
                        @else
                        Now
                        @endif
                    </p>

                </div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div id="profileModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-xl">
            <button onclick="closeProfileModal()" class="text-xl hover:bg-red-600 hover:text-white px-2 py-1 rounded-lg transition-transform transform hover:scale-105 duration-300">Close</button>
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}" alt="Profile Picture" class="w-48 h-48 rounded-full mb-4">
                <h2 class="text-2xl">{{ $user->name }}</h2>
                <p class="mt-2">{{ $user->email }}</p>
                <!-- Add more profile details as needed -->
            </div>
        </div>
    </div>

    <script>
        function openProfileModal() {
            document.getElementById('profileModal').classList.remove('hidden');
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.add('hidden');
        }
    </script>

</x-layout>
