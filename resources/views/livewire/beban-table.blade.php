<div>
    @if(session('status'))
        <div class="mb-4 px-4 py-3 bg-green-50 text-green-700 text-sm rounded-lg">
            {{ session('status') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Beban</h2>
        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">

            <span x-show="!$wire.showForm" wire:click="openForm">
                + Tambah Beban
            </span>

            <span x-show="$wire.showForm" wire:click="closeForm">
                Tutup Form
            </span>

        </button>
    </div>

    <div x-show="$wire.showForm" class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            Form Tambah Kategori
        </h3>
        <form action="" wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Beban</label>
                    <input type="text" wire:model="nama_beban"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nama_beban')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Kategori Beban</label>
                    <select wire:model="kategori_beban_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($this->kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_beban_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Harga</label>
                    <input type="number" wire:model="harga"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('harga')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
                    <textarea wire:model="deskripsi" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- flex flex-col md:flex-row gap-3 mb-4 --}}
    <div class="flex flex-col md:flex-row gap-3 mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari beban"
            class="w-full md:w-64 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

        <select wire:model.live="filterKategori"
            class="w-full md:w-48 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Kategori</option>
            @foreach($this->kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white border border-gray-200 overflow-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-medium text-gray-600">Nama Beban</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Kategori</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Harga</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Deskripsi</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Dibuat Oleh</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Tanggal</th>
                    <th class="px-4 py-3 font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($this->bebans as $beban)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-800">{{ $beban->nama_beban }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $beban->kategoriBeban->nama_kategori }}</td>
                        <td class="px-4 py-3 text-gray-600">Rp {{ number_format($beban->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $beban->deskripsi ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $beban->user->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $beban->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <button wire:click="edit({{ $beban->id }})"
                                    class="text-blue-500 hover:text-blue-700 text-xs font-medium">
                                    Edit
                                </button>
                                @if(Auth::user()->isAdmin())
                                    <button wire:click="delete({{ $beban->id }})"
                                        wire:confirm="Yakin ingin menghapus beban ini?"
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
                            Belum ada data beban.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $this->bebans->links() }}
    </div>

</div>