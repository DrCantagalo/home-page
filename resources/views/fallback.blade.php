@extends($domain . '.layouts.master')
@section('title', __('Page not found'))
@section('description', __("Page not found") . ". " . __("The page you are looking for does not exist or has been moved"))
@if($domain == 'main') { @section('meta-image', Vite::asset('resources/images/OGbw.png')) }@endif
@section('main')
    <main class="pt16 flex flex-col items-center justify-center h-[80vh] text-center px-6">
        <h1 class="text-6xl font-extrabold text-gray-800">404</h1>
        <p class="mt-4 text-lg text-gray-600">@lang('Page not found')</p>
        <p class="mt-2 text-sm text-gray-500">
            @lang("The page you are looking for does not exist or has been moved").
        </p>
        <a href="{{ url('/') }}"
        class="mt-6 inline-block text-gray-700 px-6 py-3 shadow hover:font-medium transition">
            @lang("Return to home page")
        </a>
    </main>
@endsection
