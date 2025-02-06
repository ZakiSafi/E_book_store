<x-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <form action="{{ route('login') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            @csrf

            <div class="space-y-4">
                <x-form.field>
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input type="email" id="email" name="email" :value="old('email')" required autocomplete="email" class="w-full" />
                    <x-form.error name="email" />
                </x-form.field>

                <x-form.field>
                    <x-form.label for="password">Password</x-form.label>
                    <x-form.input type="password" id="password" name="password" required autocomplete="current-password" class="w-full" />
                    <x-form.error name="password" />
                </x-form.field>

                <div class="flex justify-center">
                    <x-form.button class="w-full text-center flex items-center justify-center">Login</x-form.button>
                </div>

                <div class="flex justify-between items-center gap-2 pr-2">
                    <a href="{{route('password.forgot')}}" class="hover:underline hover:text-md hover:font-semibold hover:bg-gray-200 text-black">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="hover:underline hover:text-md font-semibold hover:bg-gray-200 text-black">Sign Up</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>