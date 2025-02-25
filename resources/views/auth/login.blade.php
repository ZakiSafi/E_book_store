<x-layout>

    <!-- Header -->
    <div class="bg-white w-full p-8">
        <div class="p-8 rounded-lg shadow-lg max-w-md w-full mx-auto border">
            <div class="text-center">
                <h1 class="text-2xl font-bold mb-2">Log In</h1>
                <p class="text-gray-600 mb-6">Log in to your account to continue.</p>
            </div>

            <form action="{{route('login.store')}}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}" required autocomplete="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <x-form.error name="email" />
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="{{ route('password.forgot') }}" class="text-sm text-blue-500 hover:text-blue-700">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            class=" relative w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" aria-label="Show password" class="toggle-password absolute top-3 right-2">
                            <i class="fas fa-eye text-sm text-gray-400"></i>
                        </button>
                    </div>

                    <x-form.error name="password" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox h-4 w-4 text-blue-600">
                    <label for="remember" class="text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Sign In Button -->
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Log In
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative flex items-center justify-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-4 text-sm text-gray-500">OR</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Google Login Button -->
                <div>
                    <a href="/login/google" class="w-full flex justify-center items-center bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-all">
                        <i class="fab fa-google mr-2"></i> Continue with Google
                    </a>
                </div>

                <!-- Sign Up Link -->
                <p class="text-center text-sm text-gray-600">
                    Not registered? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">Create an account</a>
                </p>
            </form>
        </div>
    </div>
</x-layout>
