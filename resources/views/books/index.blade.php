<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Search Books</h1>
                    <form method="GET" action="{{ route('book') }}">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search books..." 
                            value="{{ request('search') }}" 
                            class="border rounded p-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                    </form>

                    <div class="mb-4">
                        @if(auth()->user()->hasRole('pustakawan')) 
                            <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                            <x-primary-button tag="a" href="{{ route('book.print') }}">Print PDF</x-primary-button>
                            <x-primary-button tag="a" href="{{ route('book.export') }}" target="_blank">Export Excel</x-primary-button>
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'import-book')">Import Excel</x-primary-button>
                        @endif
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th>#</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Penerbit</th>
                                <th>Kota</th>
                                <th>Cover</th>
                                <th>Kode Rak</th>
                                <th>Status</th>
                                @if(auth()->user()->hasRole('pustakawan'))
                                    <th>Stok</th> 
                                    <th>Aksi</th>
                                @endif
                              
                                
                            </tr>
                        </x-slot>

                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->city }}</td>
                                <td>
                                    <img src="{{ asset('storage/cover_buku/' . $book->cover) }}" width="100px" />
                                </td>
                                <td>{{ $book->bookshelf->code }} - {{ $book->bookshelf->name }}</td>

                                <td>{{ $book->stok > 0 ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                                @if(auth()->user()->hasRole('pustakawan'))
                                    <td>{{ $book->stok }}</td> <!-- Stok hanya untuk pustakawan -->
                                @endif


                                <td>
                                    @if(auth()->user()->hasRole('pustakawan')) 
                                        <x-primary-button tag="a" href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                                        <x-danger-button 
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('book.destroy', $book->id) }}')">
                                            Delete
                                        </x-danger-button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </x-table>

                    
                    <x-modal name="confirm-book-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan, data akan dihapus secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                <x-danger-button class="ml-3">Delete!!!</x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal name="import-book" focusable maxWidth="xl">
                        <form method="post" action="{{ route('book.import') }}" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Import Data Buku') }}
                            </h2>
                            <div class="max-w-xl">
                                <x-input-label for="cover" class="sr-only" value="File Import" />
                                <x-file-input id="cover" name="file" class="mt-1 block w-full" required />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                <x-primary-button class="ml-3">Upload</x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
