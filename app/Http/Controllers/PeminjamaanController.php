<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// MODELS PEMINJAMAN
use App\Models\Peminjaman;

// MODELS BUKU
use App\Models\Buku;

// MODELS USER
use App\Models\User;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('user', 'buku')->orderBy('id', 'desc')->paginate(5);
        return view('Peminjaman.index')->with('data', $data);
    }

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $books = Buku::all();
        $data = Peminjaman::with('user', 'buku');
        return view('Peminjaman.create')->with('users', $users)
        ->with('books', $books)->with('data', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'status_peminjaman' => 'required|min:1|max:100',
        ], [
            'user_id.required' => 'Pengguna Wajib Diisi',
            'buku_id.required' => 'Buku Wajib Diisi',
            'tanggal_peminjaman.required' => 'Tanggal Peminjaman Wajib Diisi',
            'tanggal_pengembalian.required' => 'Tanggal Pengembalian Wajib Diisi',
            'status_peminjaman.required' => 'Status Peminjaman Wajib Diisi',
        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'tanggal_peminjaman' => $request->input('tanggal_peminjaman'),
            'tanggal_pengembalian' => $request->input('tanggal_pengembalian'),
            'status_peminjaman' => $request->input('status_peminjaman'),
        ];

        Peminjaman::create($data);
        return redirect('peminjaman')->with('success', 'Berhasil memasukan data');
    }

    public function modal_store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'status_peminjaman' => 'required|min:1|max:100',
        ], [
            'user_id.required' => 'Pengguna Wajib Diisi',
            'buku_id.required' => 'Buku Wajib Diisi',
            'tanggal_peminjaman.required' => 'Tanggal Peminjaman Wajib Diisi',
            'tanggal_pengembalian.required' => 'Tanggal Pengembalian Wajib Diisi',
            'status_peminjaman.required' => 'Status Peminjaman Wajib Diisi',
        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'tanggal_peminjaman' => $request->input('tanggal_peminjaman'),
            'tanggal_pengembalian' => $request->input('tanggal_pengembalian'),
            'status_peminjaman' => $request->input('status_peminjaman'),
        ];

        Peminjaman::create($data);
        return redirect('data-buku')->with('success', 'Berhasil memasukan peminjaman');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Peminjaman::with('user', 'buku')
        ->where('id', $id)->first();
        $users = User::where('role', 'peminjam')->get();
        $books = Buku::all();
        return view('Peminjaman.edit')->with('data', $data)
        ->with('users', $users)->with('books', $books);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date',
            'status_peminjaman' => 'required|min:1|max:100',
        ], [
            'user_id.required' => 'User ID wajib diisi',
            'buku_id.required' => 'Buku ID wajib diisi',
            'tanggal_peminjaman.required' => 'Tanggal peminjaman wajib diisi',
            'tanggal_pengembalian.required' => 'Tanggal pengembalian wajib diisi',
            'status_peminjaman.required' => 'Status Peminjaman wajib diisi',
        ]);

        $data = [
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'tanggal_peminjaman' => $request->input('tanggal_peminjaman'),
            'tanggal_pengembalian' => $request->input('tanggal_pengembalian'),
            'status_peminjaman' => $request->input('status_peminjaman'),
        ];

        Peminjaman::where('id', $id)->update($data);
        return redirect('peminjaman')->with('success', 'Berhasil melakukan update data');
    }

    public function destroy($id)
    {
        // Peminjaman::find($id)->delete();
        Peminjaman::where('id', $id)->delete();
        return redirect('peminjaman')->with('success', 'Berhasil melakukan hapus data');
    }
}