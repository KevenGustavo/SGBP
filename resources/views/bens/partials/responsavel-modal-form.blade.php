<div x-show="openResponsavel" x-cloak x-transition:enter="modal-transition modal-enter"
    x-transition:leave="modal-transition modal-leave-to"
    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openResponsavel = false">

    <div @click.away="openResponsavel = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
        x-show="openResponsavel" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Mudar Responsável pelo Bem</h3>
        </div>

        <form method="post" action="{{ route('bens.updateResponsavel', ['bem' => $bem->id]) }}"
            class="space-y-6 max-w-xl">
            @csrf
            @method('patch')
            <div class="mb-6">
                <x-input-label for="responsavel" value="Novo Responsável" />
                <x-select-input id="responsavel" name="responsavel" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('responsavel_id', $bem->responsavel_id) == $user->id)>
                            {{ $user->name }}</option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('responsavel')" />
            </div>

            <div class="flex items-center justify-end gap-2">
                <x-secondary-button @click="openResponsavel = false">
                    Cancelar
                </x-secondary-button>

                <x-primary-button>
                    Transferir
                </x-primary-button>
            </div>
        </form>

    </div>
</div>
