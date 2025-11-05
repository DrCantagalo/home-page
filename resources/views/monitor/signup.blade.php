@extends('monitor.layouts.master')
@section('title', __("Let's create your credentials"))
@section('description', __("When you first access the Laravel Monitor you need to create your credentials"))
@section('main')
    <main class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
            @if (!session('email_temp', false) || !session('verification_code', false))
                <form method="post" action="{{url('/')}}/handler" enctype="multipart/form-data" 
                    class="space-y-4">
                        @csrf
                        <h1 class="text-2xl font-semibold text-center text-gray-800">
                            @lang('Sign up in Laravel Monitor')
                        </h1>

                        <div>
                            <label for="secret-hash" 
                                class="block text-sm font-medium text-gray-700">
                                    @lang('Installation code')
                            </label>
                            <input id="secret-hash" type="password" 
                                name="@lang("installation-code")" autocomplete="off" autofocus
                                class="mt-1 w-full rounded-md border-gray-300 focus:ring-2 
                                focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 ">
                                @lang('Your email address')
                            </label>
                            <input id="email" type="email" value="{{ old('email') }}" name="email" 
                                required class="mt-1 w-full rounded-md border-gray-300 focus:ring-2 
                                focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex items-center space-x-2">
                            <input id="password-toggle" type="checkbox"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="password-toggle" class="text-sm text-gray-600">
                                @lang('Show the hidden texts')
                            </label>
                        </div>

                        <input type="hidden" name="user-verb" value="check-hash">

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white 
                            font-medium py-2 px-4 rounded-lg transition duration-300">
                                @lang('Send')
                        </button>
                </form>
            @else
                <form method="post" action="{{url('/')}}/handler" enctype="multipart/form-data" 
                    class="space-y-4">
                        @csrf
                        <h1 class="text-2xl font-semibold text-center text-gray-800">
                            @lang('Create Your Password')
                        </h1>

                        <div>
                            <label for="verification-code" class="block text-sm font-medium 
                                text-gray-700">@lang('Verification code')</label>
                            <input id="verification-code" 
                                value="{{ old(__('verification-code')) }}" 
                                type="password" name="@lang("verification-code")" autocomplete="off" 
                                autofocus class="mt-1 w-full rounded-md border-gray-300 focus:ring-2 
                                focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="password1" class="block text-sm font-medium 
                                text-gray-700">
                                    @lang('Create a password')
                            </label>
                            <input id="password1" 
                                value="{{ old(__('created-password')) }}" type="password" 
                                name="@lang("created-password")" required  class="mt-1 w-full rounded-md 
                                border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="password2" class="block text-sm font-medium text-gray-700">
                                @lang('Confirm your password')
                            </label>
                            <input id="password2" value="{{ old(__('password-confirmation')) }}" type="password" 
                                name="@lang("password-confirmation")" required class="mt-1 w-full rounded-md border-gray-300 
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex items-center space-x-2">
                            <input id="password-toggle" type="checkbox"
                                class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="password-toggle" class="text-sm text-gray-600">
                                @lang('Show the hidden texts')
                            </label>
                        </div>

                        <input type="hidden" name="user-verb" value="create-user">

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 
                            px-4 rounded-lg transition duration-300">
                                @lang('Send')
                        </button>
                </form>
            @endif

            @if ($errors->any())
                <ul id="errors" class="mt-4 text-sm text-red-600 list-disc list-inside bg-red-50 p-3 
                    rounded-lg">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
            @endif
        </div>
    </main>
    <script>window.lang = @json(session('lang'));</script>
@endsection
