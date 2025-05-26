<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Bens Registrados' }}
        </h2>
        @can('create', App\Models\Bem::class)
            <x-primary-link-button :href="route('bens.create')">Registrar Novo Bem</x-primary-link-button>
        @endcan
    </x-slot>

    <x-body-page>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" x-data="">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Patrimonio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Marca
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Uso
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bens as $bem)
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 cursor-pointer"
                            @click="window.location.href = '{{ route('bens.show', ['bem' => $bem['id']]) }}'">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $bem['patrimonio'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $bem['marca'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bem['tipoUso'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $bem['estado'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-body-page>
</x-app-layout>
