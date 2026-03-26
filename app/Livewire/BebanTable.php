<?php

namespace App\Livewire;

use App\Models\Beban;
use App\Models\KategoriBeban;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Livewire\WithoutUrlPagination;

class BebanTable extends Component
{
    use WithPagination, WithoutUrlPagination;
    public string $search = '';
    public string $filterKategori = '';
    public int $perPage = 5;
    public string $nama_beban = '';
    public int $kategori_beban_id;
    public string $deskripsi = '';
    public $harga = 0;
    public bool $showForm = true;

    public function render()
    {
        return view('livewire.beban-table');
    }

    public function save()
    {
        $this->validate([
            'nama_beban' => 'required|string|max:255',
            'kategori_beban_id' => 'required|exists:kategori_beban,id',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        Beban::create([
            'nama_beban' => $this->nama_beban,
            'kategori_beban_id' => $this->kategori_beban_id,
            'user_id' => Auth::id(),
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
        ]);
         session()->flash('status', 'Beban successfully created.');

        $this->reset(['nama_beban', 'kategori_beban_id', 'deskripsi', 'harga',]);

    }

    #[Computed]
    public function bebans()
    {
        return Beban::query()
            ->with(['kategoriBeban', 'user'])
            ->when($this->search, function ($query) {
                $query->where('nama_beban', 'like', '%' . $this->search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterKategori, function ($query) {
                $query->where('kategori_beban_id', $this->filterKategori);
            })
            ->latest()
            ->paginate($this->perPage);
    }

    #[Computed]
    public function kategoris()
    {
        return KategoriBeban::orderBy('nama_kategori')->get();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterKategori()
    {
        $this->resetPage();
    }

    public function resetFill()
    {
        $this->reset(['nama_beban', 'kategori_beban_id', 'deskripsi', 'harga']);
        $this->showForm = false;
    }

    public function closeForm()
    {
        $this->reset([
            'nama_beban',
            'kategori_beban_id',
            'deskripsi',
            'harga',
        ]);

        $this->showForm = false;
    }

    public function openForm()
    {
        // $this->reset([
        //     'nama_beban',
        //     'kategori_beban_id',
        //     'deskripsi',
        //     'harga',
        // ]);

        $this->showForm = true;
    }

    public function edit(int $id)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $beban = Beban::findOrFail($id);
        $this->nama_beban = $beban->nama_beban;
        $this->kategori_beban_id = $beban->kategori_beban_id;
        $this->deskripsi = $beban->deskripsi;
        $this->harga = $beban->harga;
    }

    public function delete(int $id)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $beban = Beban::findOrFail($id);
        $beban->delete();
    }
}
