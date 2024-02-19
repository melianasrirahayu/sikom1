<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku_Relasi extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 

    // RELASI DARI MODEL BUKU KE KATEGORI BUKU RELASI //
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // RELASI DARI MODEL KATEGORI BUKU KE KATEGORU BUKU RELASI //
    
    public function kategoribuku()
    {
        return $this->belongsTo(Kategoribuku::class);
    }
}