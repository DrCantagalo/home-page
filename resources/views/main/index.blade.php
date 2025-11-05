@extends('main.layouts.master')
@section('title', 'Michel Cantagalo - fullstack dev / web project manager')
@section('description', 'Michel Cantagalo - fullstack dev / web project manager')
@section('meta-image', Vite::asset('resources/images/OG.png'))
@section('main')
    <main class="pt-16 max-w-4xl mx-auto px-6 py-12 text-gray-800 leading-relaxed">
        <h2 class="text-2xl font-semibold text-center mb-8">@lang('My Tech Stack')</h2>
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-6 justify-items-center pb-16">
            @php
                $stack = [
                    ['name' => 'C++', 'icon' => Vite::asset('resources/images/c.svg')],
                    ['name' => 'CSS3', 'icon' => Vite::asset('resources/images/css.svg')],
                    ['name' => 'HTML5', 'icon' => Vite::asset('resources/images/html.svg')],
                    ['name' => 'JavaScript', 'icon' => Vite::asset('resources/images/js.svg')],
                    ['name' => 'jQuery', 'icon' => Vite::asset('resources/images/jquery.svg')],
                    ['name' => 'PHP', 'icon' => Vite::asset('resources/images/php.svg')],
                    ['name' => 'MySQL', 'icon' => Vite::asset('resources/images/mysql.svg')],
                    ['name' => 'Apache', 'icon' => Vite::asset('resources/images/apache.svg')],
                    ['name' => 'Linux', 'icon' => Vite::asset('resources/images/linux.svg')],
                    ['name' => 'Laravel', 'icon' => Vite::asset('resources/images/laravel.svg')],
                    ['name' => 'Next.js', 'icon' => Vite::asset('resources/images/next.svg')],
                    ['name' => 'Go', 'icon' => Vite::asset('resources/images/go.svg')],
                    ['name' => 'PostgreSQL', 'icon' => Vite::asset('resources/images/postgresql.svg')],
                    ['name' => 'Python', 'icon' => Vite::asset('resources/images/python.svg')],
                    ['name' => 'AWS', 'icon' => Vite::asset('resources/images/aws.svg')],
                    ['name' => 'GSAP.js', 'icon' => Vite::asset('resources/images/gsap.svg')],
                    ['name' => 'Docker', 'icon' => Vite::asset('resources/images/docker.svg')],
                    ['name' => 'Git', 'icon' => Vite::asset('resources/images/git.svg')],
                    ['name' => 'Tailwind', 'icon' => Vite::asset('resources/images/tailwind.svg')]
                ];
            @endphp 
            @foreach ($stack as $tech)
                <div class="relative group flex flex-col items-center">
                    <img src="{{ $tech['icon'] }}" 
                        alt="{{ $tech['name'] }}" 
                        class="h-12 sm:h-14 tech-logo opacity-0 hover:opacity-100 
                        hover:scale-110 transition-all duration-700 ease-out">
                    <span class="absolute bottom-[-1.5rem] text-xs text-gray-700 opacity-0 
                        group-hover:opacity-100 transition bg-white border border-gray-200 
                        rounded px-2 py-1 shadow-sm">
                            {{ $tech['name'] }}
                    </span>
                </div>
            @endforeach
        </div>
        <div>
            <h2 class="text-2xl font-semibold mb-8 flex items-center justify-center gap-2">
                @lang('My contributions on')
                <img class="h-8 inline-block" src="{{ Vite::asset('resources/images/github.svg') }}" 
                alt="GitHub" title="GitHub">
            </h2>
            <a href="https://github.com/DrCantagalo" class="calendar" target="_blank"></a>
        </div>
        <div class="text-center mt-16">
            <a href="mailto:cantagalo@gmail.com"
            class="inline-block text-lg font-medium text-gray-700 hover:text-blue-600 
            hover:underline transition">
                @lang('Reach out if interested')
            </a>
        </div>
    </main>
    <script>window.lang = @json(session('lang'));</script>
@endsection