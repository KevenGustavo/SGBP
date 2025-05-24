<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Bens Registrados' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ 'Lista de bens' }}

                    <ul role="list" class="divide-y divide-gray-100">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-gray-900">Leslie Alexander</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">leslie.alexander@example.com</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h
                                        ago</time></p>
                            </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-gray-900">Michael Foster</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">michael.foster@example.com</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="text-sm/6 text-gray-900">Co-Founder / CTO</p>
                                <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h
                                        ago</time></p>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
