@extends('_templat_back.layout')

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div>
        <h4 class="content-title mb-2">Hi, Peminjaman!</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a   href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Basic Tables</li>
            </ol>
        </nav>
    </div>
    
</div>
<!-- /breadcrumb -->
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex my-auto btn-list justify-content-end">
                    <!---------route create buku ------>
                  <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data</a>
                  <a href="{{ route('buku.create') }}" class="btn btn-success">Export Excel</a>
                  <a href="{{ route('export_pdf_buku') }}" class="btn btn-danger">Export PDF</a>
                </div>
                @include('_component.pesan')
            </div>
            <div class="card-body mt-3"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal pengembalian</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $dt)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $dt->User }}</td>
                                <td>{{ $dt->Buku }}</td>
                                <td>{{ $dt->Tanggal Peminjaman }}</td>
                                <td>{{ $dt->Tanggal pengembalian }}</td>
                                <td>{{ $dt->Status }}</td>
                                <td>{{ $dt->Action }}</td>
                                <td>
                                    <a href="{{ route('buku.edit', $dt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')"action="{{ route('buku.destroy',$dt->id)}}" method="post" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--/div-->
    @endsection