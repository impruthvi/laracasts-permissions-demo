<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl bold">Create Permission</h2>
                    <form method="post" action="{{ route('permissions.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="auth_code" :value="__('Auth Code')" />
                            <x-text-input id="auth_code" name="auth_code" type="text" class="mt-1 block w-full" :value="old('auth_code')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('auth_code')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
