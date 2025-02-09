<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <form action="{{ route('login') }}" method="POST" class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md space-y-6">
            @csrf

            <div class="space-y-6">
                <x-form.field>
                    <x-form.label for="email" class="text-gray-700 text-lg">Email</x-form.label>
                    <x-form.input type="email" id="email" name="email" :value="old('email')" required autocomplete="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                    <x-form.error name="email" />
                </x-form.field>

                <x-form.field>
                    <x-form.label for="password" class="text-gray-700 text-lg">Password</x-form.label>
                    <x-form.input type="password" id="password" name="password" required autocomplete="current-password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" />
                    <x-form.error name="password" />
                </x-form.field>

                <div class="flex justify-center">
                    <x-form.button class="w-full text-center py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">Login</x-form.button>
                </div>

                <div class="flex justify-between items-center gap-2 pr-2">
                    <a href="{{route('password.forgot')}}" class="hover:underline text-blue-600 font-medium">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="hover:underline text-blue-600 font-medium">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>
