    <!-- Sidebar Navigation -->
    <div class="p-4 rounded-lg shadow-lg col-span-1 h-64 sticky top-4 sm:block hidden">
        <div class="flex flex-col gap-3 text-[#666] text-lg">
            <a href="{{route('admin.dashboard')}}" class="group">
                <i class="fa-solid fa-tachometer-alt text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Dashboard</span>
            </a>
            <a href="{{route('admin.books.index')}}" class="group">
                <i class="fa-solid fa-book text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Manage Books</span>
            </a>
            <a href="route('admin.users.index')" class="group">
                <i class="fa-solid fa-users text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Manage Users</span>
            </a>
            <a href="/admin/settings" class="group">
                <i class="fa-solid fa-cogs text-[#666] mr-2"></i>
                <span class="group-hover:border-b group-hover:border-black">Settings</span>
            </a>
        </div>
    </div>
