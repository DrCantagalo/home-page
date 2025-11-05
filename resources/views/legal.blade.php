@extends($domain . '.layouts.master')
@section('title', __('Terms of use and privacy policy'))
@section('description', __("Terms of use and privacy policy"))
@if($domain == 'main') { @section('meta-image', Vite::asset('resources/images/OGbw.png')) }
@section('main')
<main class="pt-16 max-w-3xl mx-auto px-6 py-12 text-gray-800 leading-relaxed">
    <article class="mb-12">
        <h2 class="text-2xl font-bold mb-4 text-gray-900">@lang('Terms of Use')</h2>
        <p class="mb-3">
            @lang('This website is a personal project provided “as is,” without warranties of any kind. By using this site, you agree to respect applicable laws and use the content only for personal purposes. The site owner is not responsible for any damages or issues arising from the use of the site').
        </p>
    </article>
    <article class="mb-12">
        <h2 class="text-2xl font-bold mb-4 text-gray-900">@lang('Privacy Policy')</h2>
        <p class="mb-3">@lang('This site collects only the information necessary for basic functionality and monitoring'):</p>
        <p class="mb-2"><span class="font-semibold">@lang('Security data'):</span> @lang('Our system stores technical access information, including IP address, date, time, browser, and pages visited, exclusively for security, system maintenance, and usage statistics purposes. This data is not used for marketing or profiling purposes without consent').</p>
        <p class="mb-2"><span class="font-semibold">@lang('With consent'):</span> @lang('We also use ipapi.co to obtain your approximate location data (in JSON format). Only the language field is used to set the site language').</p>
        <p class="mb-2"><span class="font-semibold">@lang('Remembering preferences'):</span> @lang("If you allow the browser to remember your options, we create a unique token stored locally (in your browser's localStorage). This helps remember your settings and count visits").</p>
        <p>@lang('No data is sold, shared, or used for commercial purposes. All data is stored securely and used only for site monitoring').</p>
    </article>

    <article>
        <h2 class="text-2xl font-bold mb-4 text-gray-900">@lang('Cookies & Local Storage')</h2>
        <p class="mb-2">@lang('This site uses cookies and local storage'):</p>
        <ul class="list-disc list-inside mb-4">
            <li>@lang('To save your preferences').</li>
            <li>@lang('To remember your visits if you choose').</li>
        </ul>
        <p>@lang('You can refuse or delete cookies/local storage at any time in your browser settings').</p>
    </article>

    <div class="text-center mt-12">
        <a href="{{ url('/') }}"
        class="inline-block bg-gray-800 text-white px-6 py-3 rounded-xl shadow hover:bg-gray-700 transition">
            @lang('Return to home page')
        </a>
    </div>
</main>

@endsection
