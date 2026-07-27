<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-zinc-100 bg-[#09090b] min-h-screen selection:bg-indigo-500/30">
        
        <div class="min-h-screen flex flex-col justify-center items-center p-4 relative overflow-hidden">
            
            {{-- Background effects --}}
            <div class="fixed inset-0 pointer-events-none z-0">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/10 blur-[120px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/10 blur-[120px]"></div>
            </div>

            <div class="relative z-10 w-full max-w-md">
                
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center shadow-lg shadow-black/50 group-hover:border-indigo-500/50 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </a>
                </div>

                <div class="bg-[#111113] border border-zinc-800/50 rounded-2xl shadow-2xl p-6 sm:p-8 backdrop-blur-xl">
                    {{ $slot }}
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-zinc-500 hover:text-zinc-300 transition-colors">
                        &larr; Back to Portfolio
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
