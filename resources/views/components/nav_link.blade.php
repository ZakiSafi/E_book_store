@props(['active' => false])
<a class="{{$active ? 'font-bold' : ''}} text-white px-2 py-1 hover:bg-white hover:text-blue-600 text-[14px] flex items-center justify-center rounded-md "
    {{ $attributes }}>{{ $slot }}</a>
