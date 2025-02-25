<div id="profileModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-xl">
        <button id="close-popup" class="text-xl hover:bg-red-600 hover:text-white px-2 py-1 rounded-lg transition-transform transform hover:scale-105 duration-300">Close</button>
        <div class="flex flex-col items-center">
            {{$slot}}
        </div>
    </div>
</div>