<div x-show="openResponsavel" x-cloak style="display: none;" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-500/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openResponsavel = false">

    <div @click.away="openResponsavel = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg"
        x-show="openResponsavel" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <form method="post" action="{{ route('bens.updateResponsavel', $bem->id) }}" class="p-6">
            @csrf
            @method('patch')

            <div class="border-b pb-3 mb-6">
                <h3 class="text-lg font-bold text-gray-900">
                    Transferir Responsabilidade do Bem
                </h3>
                <div class="text-sm text-gray-600 mt-2 space-y-1">
                    <p>Patrimônio: <span class="font-semibold">{{ $bem->patrimonio }}</span></p>
                    <p>Responsável Atual: <span class="font-semibold">{{ $bem->user->name ?? 'N/A' }}</span></p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <x-input-label for="responsavel_id" value="Selecione o Novo Responsável" />
                    <x-select-input id="responsavel_id" name="responsavel_id" class="mt-1 block w-full" required>
                        <option value="" disabled>Selecione um usuário...</option>
                        @foreach ($users as $user)
                            @if ($user->id !== $bem->responsavel_id)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endif
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('responsavel_id')" />
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t">
                <x-secondary-button type="button" @click.prevent="openResponsavel = false">
                    Cancelar
                </x-secondary-button>

                <x-primary-button type="submit">
                    Transferir
                </x-primary-button>
            </div>
        </form>

    </div>
</div>
