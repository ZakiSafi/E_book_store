<div class="p-4 rounded-lg shadow-lg col-span-1 h-auto self-start bg-white">
    <div class="grid grid-cols-[20px,auto] items-center  gap-3 text-[#666] text-lg">
        @auth
        @if (Auth::user()->role == 'admin')

        <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
        <a href="{{route('admin.dashboard')}}" class="group flex items-center gap-4">
            <span class="group-hover:border-b group-hover:border-black">Admin Dashboard</span>
        </a>

        <i class="fa-solid fa-book text-[#666] mr-2"></i>
        <a href="{{route('admin.books.physicalBooks')}}" class="group">
            <span class="group-hover:border-b group-hover:border-black">Manage Books</span>
        </a>

        <i class="fa-solid fa-book-open text-[#666] mr-2"></i>
        <a href="{{route('admin.borrow-books.index')}}" class="group">
            <span class="group-hover:border-b group-hover:border-black">Borrowed Books</span>
        </a>

        <i class="fa-solid fa-history text-[#666] mr-2"></i>
        <a href="{{route('admin.borrow-books.history')}}" class="group">
            <span class="group-hover:border-b group-hover:border-black">Borrowed History</span>
        </a>

        <i class="fa-solid fa-users text-[#666] mr-2"></i>
        <a href="{{ route('admin.users.index') }}" class="group">
            <span class="group-hover:border-b group-hover:border-black">Manage Users</span>
        </a>

        @else

        <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
        <a href="{{route('user.dashboard')}}" class="group flex items-center">
            <span class="group-hover:border-b group-hover:border-black">Dashboard</span>

        </a>


        @endif
        @endauth

        <i class="fa-solid fa-book text-[#666] mr-2"></i>
        <a href="{{route('user.books')}}" class="group flex items-center">
            <span class="group-hover:border-b group-hover:border-black">Manage your Books</span>
        </a>

        <i class="fa-solid fa-user text-[#666] mr-2"></i>
        <a href="{{ route('user.profile.edit') }}" class="group flex items-center">
            <span class="group-hover:border-b group-hover:border-black">Edit Profile</span>
        </a>

        <i class="fa-solid fa-bookmark text-[#666] mr-2"></i>
        <a href="{{route('user.bookmarks.index')}}" class="group flex items-center">
            <span class="group-hover:border-b group-hover:border-black">Bookmarks</span>
        </a>
    </div>
</div>
