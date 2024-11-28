@extends('admin.layouts.app')

@section('title', 'Add New Admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Add New Admin</h2>
        <a href="{{ route('admin.dashboard') }}" 
           class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200">
            Back to List
        </a>
    </div>

    <!-- Form Container -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-10">
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" 
                                class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 
                                       border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 
                                       focus:border-blue-400 transition duration-200
                                       @error('name') border-red-300 ring-red-100 @enderror"
                                value="{{ old('name') }}"
                                placeholder="Enter full name"
                                required>
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 
                                       border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 
                                       focus:border-blue-400 transition duration-200
                                       @error('email') border-red-300 ring-red-100 @enderror"
                                value="{{ old('email') }}"
                                placeholder="Enter email address"
                                required>
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" id="password"
                                class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 
                                       border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 
                                       focus:border-blue-400 transition duration-200
                                       @error('password') border-red-300 ring-red-100 @enderror"
                                placeholder="Enter password"
                                required>
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 
                                       border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 
                                       focus:border-blue-400 transition duration-200"
                                placeholder="Confirm password"
                                required>
                        </div>
                    </div>

                    <!-- Submit Button - Updated to match login button style -->
                    <div class="mt-10">
                        <button type="submit" 
                            class="btn btn-primary btn-block" 
                            style="margin-top: 15px; height: 42px; font-size: 15px; font-weight: 500; width: 100%; 
                                   background-color: #2563eb; color: white; border: none; 
                                   border-radius: 6px; cursor: pointer;">
                            Create Admin Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 