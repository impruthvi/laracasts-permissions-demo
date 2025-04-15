<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between pb-10">
                        <h3 class="bold text-xl">Users</h3>
                    </div>
                    <table class="w-full ">
                        <thead>
                        <tr>
                            <th class="text-start">Name</th>
                            <th class="text-start">Email address</th>
                            <th class="text-start">Admin</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="border-t-gray-200 border-t">
                                <td class="py-4">{{$user->name}}</td>
                                <td class="py-4">{{ $user->email }}</td>
                                <td class="py-4">{{ $user->is_admin }}</td>

                                <td class="flex py-4 justify-end">
                                    <a href="{{route('users.edit', ['user' => $user->id])}}"
                                       class="bg-gray-500 hover:bg-gray-600 mr-1 py-2 px-3 rounded-md text-white">
                                        Edit
                                    </a>
                                    <form
                                        method="post" action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
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
