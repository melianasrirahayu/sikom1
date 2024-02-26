<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//MODELS KOLEKSI PRIBADI
use App\Models\Koleksi_pribadi;

class KoleksiPribadiController extends Controller
{
    public function index()
    {
        $data = Koleksi_pribadi::orderBy('id', 'desc')->paginate(5);
        return view('Koleksi-pribadi.index')->with('data', $data);
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
