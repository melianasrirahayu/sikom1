<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    //RELASI ANTAR TABLE//
    // RELASI DARI MODEL KATEGORI BUKU KE KATEGORI BUKU RELASI //
    public function kategoribuku_relasi()
    {
        return $this->hasMany(Kategoribuku_relasi::class);
    }
}