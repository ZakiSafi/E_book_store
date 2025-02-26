@props(['value' => ''])
<form action="{{ route('adminSearch') }}" method="GET" class="flex items-center">
    <input type="text" name="query" placeholder="Search {{$value}}..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
    <input type="hidden" name="search_type" value="{{ $value }}">
    <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
        <i class="fa-solid fa-search"></i>
    </button>
</form>