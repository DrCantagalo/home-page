    <div class="flex space-x-2">
@if ($lang == 'it')
        <button type="button" onclick="changeLang('en', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/enflag.png') }}' 
            class="h-4 w-auto object-contain" alt="English flag">
        </button>
        <button type="button" onclick="changeLang('pt', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/brflag.png') }}' 
            class="h-4 w-auto object-contain" alt="Brazilian flag">
        </button>
@elseif ($lang == 'pt')
        <button type="button" onclick="changeLang('en', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/enflag.png') }}' 
            class="h-4 w-auto object-contain" alt="English flag">
        </button>
        <button type="button" onclick="changeLang('it', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/itflag.png') }}' 
            class="h-4 w-auto object-contain" alt="Italian flag">
        </button>
@else
        <button type="button" onclick="changeLang('it', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/itflag.png') }}' 
            class="h-4 w-auto object-contain" alt="Italian flag">
        </button>
        <button type="button" onclick="changeLang('pt', {{ $option }})" 
        class="flex items-center justify-center p-1 bg-gray-200 
        hover:bg-gray-300 rounded cursor-pointer">
            <img src='{{ Vite::asset('resources/images/brflag.png') }}' 
            class="h-4 w-auto object-contain" alt="Brazilian flag">
        </button>
@endif
    </div>