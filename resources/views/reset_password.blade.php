@extends('layouts.app')

@section('title', 'Forget Password')
@section('content')
  <!-- Form Container -->
    <div class=" flex items-center justify-center " style="margin-top: 50px; margin-bottom:50px;">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold  text-center">Forget Password</h2>

            <form action="{{ route('reset.password') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="mt-1 block w-full px-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        value="{{ old('email') }}">
                    <i
                        class="fa-solid fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="relative">
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new password"
                        class="mt-1 block w-full px-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <button type="button" onclick="togglePassword('new_password')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <input type="password" name="new_password_confirmation" id="confirm_password"
                        placeholder="Confirm new password"
                        class="mt-1 block w-full px-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <button type="button" onclick="togglePassword('confirm_password')"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    @error('confirm_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-400 to-indigo-500 hover:opacity-90 text-white font-medium py-2.5 rounded-lg shadow-md transition duration-300">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
