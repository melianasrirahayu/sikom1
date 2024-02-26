<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Buku;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DataBukuExportView;
use App\Imports\ImportDataBukuClass;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('data_buku.index',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_buku.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun_terbit wajib diisi',

            ],
        );
        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,

        ];

        Buku::create($data);
        return redirect()->route('buku.index')->with('success','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = Buku::find($id);
        return view('data_buku.form_edit', compact('dt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun_terbit wajib diisi',

            ],
        );
        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,

        ];

        Buku::where('id',$id)->update($data);
        return redirect()->route('buku.index')->with('success','Data Berhasil Di Edit');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();
        return back()->with('succes', 'Data Berhasil Di Hapus');
    }
    public function export_pdf()//membuat pdf
    {
        $data = Buku::orderBy('judul', 'asc');
        $data = $data->get();

        //membuka halaman yang ada di data buku di folder data buku
        $pdf = PDF::loadview('data_buku.exportPdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        //untuk memberi nama di file nya
        $filename = date('YmsdHis') . '_data_buku';
        //untuk mendowload
        return $pdf->download($filename.'.pdf');
    }

    public function export_excel(Request $request) 
    {
        //query mengambil data dari data base
        $data = Buku::select('*');
        $data = $data->get();

        //untuk mengakses yang sudah di dowload
        $export = new DataBukuExportView($data);
    
        //untuk memberi nama di file
        $filename = date('YmdHis') . '_data_buku';

        //untuk mendowload
        return Excel::download($export, $filename . '.xlsx');
    }
//membuat import excel
    public function import_excel(Request $request)
    {
        //DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataBukuClass;
                Excel::import($import, $file);
                
                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return back()
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }
            
		}
		catch(Exception $e){
			// ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }
}
