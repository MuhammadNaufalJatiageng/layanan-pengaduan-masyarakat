<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $guarded = ['id'];
    
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
