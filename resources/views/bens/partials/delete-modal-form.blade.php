<div x-show="openDelete" x-cloak x-transition:enter="modal-transition modal-enter"
    x-transition:leave="modal-transition modal-leave-to"
    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openDelete = false">

    <div @click.away="openDelete = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
        x-show="openDelete" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <div class="flex justify-between items-center pb-3 mb-4 gap-3">
            <div
                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                {{-- Ícone de Alerta (Heroicon) --}}
                <svg class="h-6 w-6  text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Tem certeza que deseja excluir o Bem:{{ $bem->patrimonio }}?</h3>
        </div>


        <form method="post" action="{{ route('bens.delete', ['bem' => $bem->id]) }}"
            class="space-y-6 max-w-xl">
            @csrf
            @method('delete')

            <div class="flex items-center justify-end gap-2">
                <x-secondary-button @click="openLocalizacao = false">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Excluir
                </x-danger-button>
            </div>
        </form>

    </div>
</div>
