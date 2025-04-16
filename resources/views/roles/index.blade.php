<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between pb-10">
                        <h3 class="bold text-xl">Roles</h3>
                        <div>
                            <a href="{{ route('roles.create') }}"
                               class="bg-indigo-500 hover:bg-indigo-600 py-2 px-3 rounded-md text-white">
                                Create
                            </a>
                        </div>
                    </div>
                    <table class="w-full ">
                        <thead>
                        <tr>
                            <th class="text-start">Role Name</th>
                            <th class="text-start">Auth Code</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr class="border-t-gray-200 border-t">
                                <td class="py-4">{{$role->name}}</td>
                                <td class="py-4">{{$role->auth_code}}</td>

                                <td class="flex py-4 justify-end">

                                    <a href="{{route('roles.edit', ['role' => $role->id])}}"
                                       class="bg-gray-500 hover:bg-gray-600 mr-1 py-2 px-3 rounded-md text-white">
                                        Edit
                                    </a>
                                    <form
                                        method="post"
                                        action="{{ route('roles.destroy', ['role' => $role->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this role?')"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="bg-red-400 hover:bg-red-500 py-2 px-3 rounded-md text-white">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
