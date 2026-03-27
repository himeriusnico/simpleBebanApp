<div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">
        Form Tambah Kategori
    </h3>
    <form action="" wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="flex flex:auto block text-sm text-gray-600 mb-1">Nama Kategori</label>
                <input type="text" wire:model="nama_kategori"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="mt-2 mb-2">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                Simpan
            </button>
        </div>
    </form>

    <div class="bg-white border border-gray-200 overflow-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">Nama Kategori</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($this->kategoris as $kategori)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-800">{{ $kategori->nama_kategori }}</td>
                        {{-- <td class="px-4 py-3 text-gray-600">{{ $kategori->user->name }}</td> --}}
                        <td class="px-4 py-3 text-gray-600">{{ $kategori->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <button wire:click="edit({{ $kategori->id }})"
                                    class="text-blue-500 hover:text-blue-700 text-xs font-medium">
                                    Edit
                                </button>
                                @if(Auth::user()->isAdmin())
                                    <button wire:click="delete({{ $kategori->id }})"
                                        wire:confirm="Yakin ingin menghapus kategori ini?"
                                        class="text-red-500 hover:text-red-700 text-xs font-medium">
                                        Hapus
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>