<div x-show="openDelete" x-cloak x-transition:enter="modal-transition modal-enter"
    x-transition:leave="modal-transition modal-leave-to"
    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openDelete = false">

    <div @click.away="openDelete = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
        x-show="openDelete" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <div class="flex justify-between items-center pb-3 mb-4">
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
