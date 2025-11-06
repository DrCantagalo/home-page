<div id="cookie-overlay" 
    class="fixed inset-0 bg-gray-800/40 backdrop-blur-sm z-101 flex items-end justify-end p-4">

    <form id="cookie-form" 
        class="w-80 bg-white shadow-lg rounded-xl p-6 text-sm text-gray-700 space-y-4 z-102">

        @include('partials.lang-switcher', ['option' => 1, 'lang' => $lang])

        <h2 class="text-lg font-semibold">@lang('Your Privacy is Important')</h2>

        <p class="text-xs leading-relaxed">
            @lang('This website uses cookies to personalize your experience. To understand how we use your data, please read our')
            <a href="{{ route($domain . '.legal') }}" class="text-blue-600 underline hover:text-blue-800">
                @lang('Terms of Use and Privacy Policy')
            </a>.
        </p>

        <p class="text-xs leading-relaxed">@lang('Check the boxes to give your consent'):</p>

        <div class="flex items-start space-x-2">
            <input id="get-data-auth" name='get-data-auth' type="checkbox" class="mt-1">
            <label for="get-data-auth" class="text-xs">
                @lang('I authorize the collection and use of my data as described in the Privacy Policy').
            </label>
        </div>

        <div class="flex items-start space-x-2">    
            <input id="remember-decision" name='remember-decision' type="checkbox" class="mt-1">
            <label for="remember-decision" class="text-xs">
                @lang('Remember my answer in this browser')
            </label>
        </div>

        <button type="submit" id='cookie-btn' 
            class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            @lang('Send')
        </button>
    </form>
</div>
