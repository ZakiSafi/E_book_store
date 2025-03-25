<x-layout>
    <!-- Container -->
    <div class="bg-white w-full flex justify-center items-center min-h-vh p-4">
        <div class="p-6 rounded-lg shadow-sm max-w-sm w-full border border-gray-100 bg-white">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                <p class="text-sm text-gray-500">Log in to continue to your account</p>
            </div>

            <!-- Form -->
            <form action="{{ route('login.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="relative mt-1">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400">
                        <i class="fas fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>
                    <x-form.error name="email" />
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex justify-between items-center">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="{{ route('password.forgot') }}" class="text-xs text-blue-600 hover:text-blue-700">Forgot password?</a>
                    </div>
                    <div class="relative mt-1">
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm placeholder-gray-400">
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 text-sm toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <x-form.error name="password" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500">
                    <label for="remember" class="text-gray-600">Remember me</label>
                </div>

                <!-- Log In Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log In
                </button>

                <!-- Divider -->
                <div class="flex items-center justify-center my-4">
                    <div class="flex-1 border-t border-gray-200"></div>
                    <span class="mx-3 text-sm text-gray-400">OR</span>
                    <div class="flex-1 border-t border-gray-200"></div>
                </div>

                <!-- Google Login Button -->
                <a href="/login/google" class="w-full flex items-center justify-center bg-white text-gray-700 py-2 rounded-md text-sm font-semibold border border-gray-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <i class="fab fa-google mr-2 text-red-500"></i> Continue with Google
                </a>

                <!-- Sign Up Link -->
                <p class="text-center text-sm text-gray-500 mt-4">
                    Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</x-layout>
