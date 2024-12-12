<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Search users</h1>
                    <form method="GET" action="{{ route('users.index') }}">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search users..." 
                            value="{{ request('search') }}" 
                            class="border rounded p-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                    </form>

                    <div class="mb-4">
                        @if(auth()->user()->hasRole('pustakawan')) 
                            <x-primary-button tag="a" href="{{ route('users.create') }}">Tambah Data User</x-primary-button>
                        @endif
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </x-slot>

                        @foreach ($users as $user)
                        @if ($user->name !== 'pustakawan')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(auth()->user()->hasRole('pustakawan'))
                                        <x-primary-button tag="a" href="{{ route('users.edit', $user->id) }}">Edit</x-primary-button>
                                        <x-danger-button 
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('users.destroy', $user->id) }}')">
                                            Delete
                                        </x-danger-button>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </x-table>

                    <x-modal name="confirm-user-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data ini?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses ini, data akan dihapus secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                <x-danger-button class="ml-3">Delete!!!</x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
