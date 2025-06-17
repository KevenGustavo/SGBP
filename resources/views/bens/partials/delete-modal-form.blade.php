<div x-show="openDelete" x-cloak style="display: none;" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-500/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openDelete = false">

    <div @click.away="openDelete = false" class="bg-white rounded-lg shadow-xl w-full max-w-md" x-show="openDelete"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

        <div class="p-6">
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-bold text-gray-900">
                        Confirmar Exclusão
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">
                            Tem certeza que deseja excluir o bem de patrimônio:
                            <strong class="block mt-1 text-base">{{ $bem->patrimonio }}</strong>
                            Esta ação não poderá ser desfeita.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-lg">
            <form method="post" action="{{ route('bens.delete', $bem->id) }}" class="inline-block">
                @csrf
                @method('delete')

                <x-danger-button type="submit">
                    Sim, Excluir
                </x-danger-button>
            </form>
            <x-secondary-button @click.prevent="openDelete = false" class="mt-3 sm:mt-0 sm:mr-3">
                Cancelar
            </x-secondary-button>
        </div>

    </div>
</div>
