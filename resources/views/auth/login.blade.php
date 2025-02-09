<x-layout>
    <div class="flex justify-center items-center min-h-screen p-6 ">
        <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-extrabold text-gray-800">Login</h2>
                <p class="text-gray-500">Access your account</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" :value="old('email')" required autocomplete="email"
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <x-form.error name="email" />
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <x-form.error name="password" />
                </div>

                <div class="flex justify-between items-center text-sm">
                    <a href="{{route('password.forgot')}}" class="text-blue-600 hover:underline">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign Up</a>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg shadow-lg hover:bg-blue-700 transition-all">
                    Sign In
                </button>

                <div class="relative flex items-center justify-center my-6">
                    <span class="absolute bg-white px-4 text-gray-500">or</span>
                    <div class="border-t border-gray-300 w-full"></div>
                </div>

                <a href="/login/google" class="w-full flex justify-center items-center bg-red-500 text-white p-3 rounded-lg hover:bg-red-600 transition-all">
                    <i class="fab fa-google mr-2"></i> Continue with Google
                </a>
            </form>
        </div>
    </div>
</x-layout>
