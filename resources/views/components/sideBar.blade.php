<div class="p-4 rounded-lg shadow-lg col-span-1 h-48 bg-white">
    <div class="flex flex-col gap-3 text-[#666] text-lg">
        @auth
        @if (Auth::user()->role == 'admin')
        <a href="{{route('admin.dashboard')}}" class="group flex items-center">
            <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Admin Dashboard</span>
        </a>
        <a href="{{route('admin.books.index')}}" class="group">
            <i class="fa-solid fa-book text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Manage Books</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="group">
            <i class="fa-solid fa-users text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Manage Users</span>
        </a>
        <a href="/admin/settings" class="group">
            <i class="fa-solid fa-cogs text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Settings</span>
        </a>
        @else
        <a href="{{route('user.dashboard')}}" class="group flex items-center">
            <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Dashboard</span>

        </a>


        @endif
        @endauth
        <a href="{{route('user.books')}}" class="group flex items-center">
            <i class="fa-solid fa-book text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
        </a>

        <a href="{{ route('user.profile.edit') }}" class="group flex items-center">
            <i class="fa-solid fa-user text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
        </a>
        <a href="{{route('user.bookmarks.index')}}" class="group flex items-center">
            <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
            <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
        </a>
    </div>
</div>
