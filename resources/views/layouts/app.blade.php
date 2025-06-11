<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

            {{-- Container para as mensagens flash --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
                {{-- Mensagem de Sucesso --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                {{-- Ícone de Sucesso (Opcional - Heroicon) --}}
                                <svg class="h-6 w-6 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">Sucesso!</p>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Mensagem de Erro --}}
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                {{-- Ícone de Erro (Opcional - Heroicon) --}}
                                <svg class="h-6 w-6 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">Erro!</p>
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Mensagem de Aviso --}}
                @if (session('warning'))
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded-md shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                {{-- Ícone de Aviso (Opcional - Heroicon) --}}
                                <svg class="h-6 w-6 text-yellow-500 mr-3" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">Atenção!</p>
                                <p>{{ session('warning') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Mensagem de Informação --}}
                @if (session('info'))
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded-md shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="py-1">
                                {{-- Ícone de Informação (Opcional - Heroicon) --}}
                                <svg class="h-6 w-6 text-blue-500 mr-3" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold">Informação:</p>
                                <p>{{ session('info') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Para exibir erros de validação do Laravel --}}
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md shadow-md"
                        role="alert">
                        <p class="font-bold">Por favor, corrija os seguintes erros:</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>
    </div>
</body>

</html>
