<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama_kategori'])]
class KategoriBeban extends Model
{
    protected $table = 'kategori_beban';

    public function bebans(): HasMany
    {
        return $this->hasMany(Beban::class);
    }
}
