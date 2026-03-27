<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\KategoriBeban as ModelsKategoriBeban;
use Illuminate\Support\Facades\Auth;

class KategoriBeban extends Component
{
    public string $nama_kategori = '';
    public string $search = '';
    public int $perPage = 5;
    public ?int $editingId = null;

     public function save()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        if($this->editingId){
            ModelsKategoriBeban::findOrFail($this->editingId)->update([
                'nama_kategori' => $this->nama_kategori,
            ]);

            session()->flash('status', 'Kategori Beban successfully updated.');
        }
        else {
            ModelsKategoriBeban::create([
                'nama_kategori' => $this->nama_kategori,
            ]);

            session()->flash('status', 'Kategori Beban successfully created.');

        }
        $this->reset(['nama_kategori']);
    }

    public function edit($id)
    {
        $kategori = ModelsKategoriBeban::findOrFail($id);
        $this->editingId = $id;
        $this->nama_kategori = $kategori->nama_kategori;
    }

    public function delete(int $id)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $kategori = ModelsKategoriBeban::findOrFail($id);
        $kategori->delete();
    }

    #[Computed]
    public function kategoris()
    {
        return ModelsKategoriBeban::query()
           ->when($this->search, function ($query) {
        $query->where('nama_kategori', 'like', '%' . $this->search . '%');
    })
            ->latest()
            ->paginate($this->perPage);
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterKategori()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.kategori-beban');
    }
}
