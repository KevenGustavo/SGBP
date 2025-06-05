<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{ route('relatorio') }}" target="_blank" class="bg-blue-500 text-white p-2 rounded">
            Gerar Relatório Geral de Bens
        </a>
    </x-slot>

    <x-body-page>
        <div class="flex justify-between bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900">
            {{ __("You're logged in!") }}
        </div>
    </x-body-page>
</x-app-layout>
