<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = ['id']; // MENGATUR HANYA COLUMN ID YANG TIDAK BOLEH DI ISI //

    // RELASI DI MODEL BUKU //

    public function ulasabuku()  //RELASI ULASAN BUKU//
    {
        return $this->hasMany(UlasanBuku::class);
    }
        // RELASI DARI MODEL BUKU KE KOLEKSI PRIBASDI //
    public function koleksipribadi()
    {
        return $this->hasMany(KoleksiPiribadi::class);
    }
        // RELASI DARI MODEL BUKU KE KATEGORI BUKU RELASI //
    public function kategoribuku_relasi()
    {
        return $this->hasMany(KategoriBuku_relasi::class);
    }
        // RELASI DARI MODEL BUKU KE PEMINJAMAN //
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}