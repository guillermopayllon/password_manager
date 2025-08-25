<div class="p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Mis Contraseñas</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Formulario para Añadir/Editar Contraseña -->
    <form wire:submit.prevent="{{ $isEditing ? 'updatePassword' : 'savePassword' }}" class="mb-8">
        <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4">{{ $isEditing ? 'Editar Contraseña' : 'Añadir Nueva Contraseña' }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Servicio</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <!-- Campo Contraseña con Toggle -->
            <div x-data="{ showPassword: false }">
                <label for="password_input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Contraseña @if($isEditing) (dejar en blanco para no cambiar) @endif
                </label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" id="password_input" wire:model="password_input" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 pr-10">
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 dark:text-gray-400">
                        <i class="fas" :class="{ 'fa-eye': !showPassword, 'fa-eye-slash': showPassword }"></i>
                    </button>
                </div>
                @error('password_input') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <!-- Campo Confirmar Contraseña con Toggle -->
            <div x-data="{ showPassword: false }">
                <label for="password_input_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Contraseña</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" id="password_input_confirmation" wire:model="password_input_confirmation" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 pr-10">
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 dark:text-gray-400">
                        <i class="fas" :class="{ 'fa-eye': !showPassword, 'fa-eye-slash': showPassword }"></i>
                    </button>
                </div>
                @error('password_input_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL (Opcional)</label>
                <input type="url" id="url" wire:model="url" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                @error('url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="two_factor_secret" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Clave Secreta 2FA (TOTP - Opcional)</label>
                <input type="text" id="two_factor_secret" wire:model="two_factor_secret" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                @error('two_factor_secret') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notas (Opcional)</label>
                <textarea id="notes" wire:model="notes" rows="3" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <!-- Implementación futura para adjuntos -->
        </div>
        <div class="mt-6 flex items-center">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $isEditing ? 'Actualizar Contraseña' : 'Guardar Contraseña' }}
            </button>
            @if ($isEditing)
                <button type="button" wire:click="cancelEdit" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                    Cancelar
                </button>
            @endif
        </div>
    </form>

    <!-- Lista de Contraseñas -->
    <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100 mb-4 mt-8">Tus Contraseñas Guardadas</h3>
    @if ($passwords->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">Aún no has guardado ninguna contraseña.</p>
    @else
        <div class="overflow-x-auto rounded-md shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contraseña</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">URL</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($passwords as $password)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $password->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                @if ($showPasswordId === $password->id)
                                    <span x-data="{ textToCopy: '{{ $this->getDecryptedPassword($password->id) }}' }"
                                          x-init="$nextTick(() => { 
                                              if ('clipboard' in navigator) {
                                                  navigator.clipboard.writeText(textToCopy);
                                              } else {
                                                  // Fallback for older browsers (not always reliable in iframes)
                                                  const textarea = document.createElement('textarea');
                                                  textarea.value = textToCopy;
                                                  document.body.appendChild(textarea);
                                                  textarea.select();
                                                  document.execCommand('copy');
                                                  document.body.removeChild(textarea);
                                              }
                                          })"
                                          class="text-green-500 font-semibold">
                                        {{ $this->getDecryptedPassword($password->id) }}
                                    </span>
                                @else
                                    ••••••••••••••••
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                @if ($password->url)
                                    <a href="{{ $password->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                                        {{ Str::limit($password->url, 30) }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="togglePasswordVisibility({{ $password->id }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-2">
                                    <i class="fas" :class="{ 'fa-eye': showPasswordId !== {{ $password->id }}, 'fa-eye-slash': showPasswordId === {{ $password->id }} }"></i>
                                </button>
                                <button wire:click="editPassword({{ $password->id }})" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-600 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="deletePassword({{ $password->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" xintegrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
