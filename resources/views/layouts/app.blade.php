<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>[x-cloak]{ display:none }</style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased" id="app">
        <div class="min-h-screen bg-gray-50">
            @livewire('navigation-dropdown')

            @if(!Request::is('dashboard'))
                <!-- Page Heading -->
                <header class="relative pl-64">
                    <div class="w-full py-5 mx-auto sm:px-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="pl-64 @if(Request::is('dashboard')){{ 'pt-5' }}@endif">
                {{ $slot }}
            </main>
        </div>
        @livewire('check-user-badges')

            @if(Request::get('onboard'))
                <x-modal max-width="lg" x-data="{ show: true }" :show="true" class="p-10">
                    <div class="relative">
                        <img src="/images/onboard-bg.jpg" class="object-cover object-bottom w-full h-40">
                        <div class="absolute top-0 right-0 mt-3 mr-3">
                            <svg @click="show=false" class="w-6 h-6 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                    </div>
                    <div class="p-5">
                        <h2 class="text-xl">Welcome to Your Dashboard</h2>
                        <p class="py-4 text-lg text-gray-500">This is your guild dashboard. On your dashboard you can post a quick message in your company feed, start your shift, and view your guild status.</p>
                        <p class="py-2 pb-4 text-lg text-gray-500">Next, you may want to add a few more members to your guild <a href="/teams/{{ auth()->user()->currentTeam->id }}" class="text-green-400 underline">Click here to add more members</a></p>
                        <button @click="show=false" class="inline-flex items-center justify-center flex-shrink-0 w-auto w-full px-4 py-4 mt-4 text-lg font-semibold tracking-wide text-center text-white transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">Awesome! Let's go.</button>

                    </div>
                </x-modal>
            @endif

        @stack('modals')

        @livewireScripts
    </body>
</html>
