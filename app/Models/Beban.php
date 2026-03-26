<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'kategori_beban_id', 'user_id', 'deskripsi'])]
class Beban extends Model
{
    protected $table = 'beban';

    public function kategoriBeban(): BelongsTo
    {
        return $this->belongsTo(KategoriBeban::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}   
