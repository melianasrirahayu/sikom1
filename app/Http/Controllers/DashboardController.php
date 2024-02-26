<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ulasan_buku;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_buku = Buku::count();
        $total_peminjaman = Peminjaman::count();
        $total_ulasan_buku = Ulasan_buku::count();
        $total_pengguna = User::count();

        return view('Dashboard.index', compact(
            'total_buku', 'total_peminjaman', 'total_ulasan_buku', 'total_pengguna'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
