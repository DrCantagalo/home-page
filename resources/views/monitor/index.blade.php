@extends('monitor.layouts.master')
@section('title', 'Laravel Monitor')
@section('description', 'Laravel Monitor')
@section('main')
    <main class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
            <form method="post" action="signin" enctype="multipart/form-data" 
                class="space-y-4">
                @csrf
                <h1 class="text-2xl font-semibold text-center text-gray-800">
                    @lang('Sign in to') Laravel Monitor
                </h1>
                <div>
                    <label for="email" 
                        class="block text-sm font-medium text-gray-700">
                            Email
                    </label>
                    <input id="email" type="email" 
                        name="email" value="{{ old('email') }}" autofocus required
                        class="mt-1 w-full rounded-md border-gray-300 focus:ring-2 
                        focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="password1" class="block text-sm font-medium 
                        text-gray-700"> Password </label>
                        <input id="password1" 
                            value="{{ old('password') }}" type="password" 
                            name="password" required class="mt-1 w-full rounded-md border-gray-300 
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center space-x-2">
                    <input id="password-toggle" type="checkbox"
                        class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="password-toggle" class="text-sm text-gray-600">
                        @lang('Show the hidden texts')
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember-me" class="text-sm text-gray-600">
                        @lang('Remember me in the next visit')
                    </label>
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white 
                    font-medium py-2 px-4 rounded-lg transition duration-300">
                        @lang('Send')
                </button>
            </form>
            @if ($errors->any())
                <ul id="errors" class="mt-4 text-sm text-red-600 list-disc list-inside bg-red-50 p-3 
                    rounded-lg">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
            @endif
            <div class="w-full py-4 bg-white text-center text-sm text-gray-600">
                <a href="{{ route('monitor.password') }}" 
                class="hover:text-gray-800 hover:font-medium transition">
                    @lang('Forgot your password?')
                </a>
            </div>
            <div class="w-full py-4 bg-white text-center text-sm text-gray-600">
                <a href="{{ route('monitor.signup') }}" 
                class="hover:text-gray-800 hover:font-medium transition">
                    @lang("Don't have an account yet? Sign up!")
                </a>
            </div>
        </div>
    </main>
    <script>window.lang = @json(session('lang'));</script>
@endsection