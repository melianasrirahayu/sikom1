@extends('Template-back.layout')
@section('content')
@section('title', 'Data Pengguna')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div>
        <h4 class="content-title mb-2">DATA PENGGUNA</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a   href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Data Pengguna</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /breadcrumb -->

<!--div-->
<div class="row row-sm">
    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="pd-t-10 pd-s-10 pd-e-10 bg-white bd-b">
                <div class="row">
                    <div class="col-md-6">
                        <p>Data Pengguna</p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex my-auto btn-list justify-content-end">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalPenggunaCreate"><i class="fa fa-plus me-2"></i>Tambah</button>
                            <a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-upload me-2"></i> Import</a>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fa fa-download me-2"></i>Export
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Excel</a>
                                    <a class="dropdown-item" href="#">PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- message info -->
                @include('Komponen.message')
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label mt-2 mb-0">Kategori Pengguna</label>
                        <select class="form-control select2" onchange="reload_table()">
                            <option value=""><option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-md-nowrap mb-3" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($data as $item)
                        <tbody>
                            <tr>
                                <td>{{ $data->firstItem() + $loop->index }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    <a href="" class="btn btn-info btn-sm"><i class="fe fe-edit"></i>EDIT</a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fe fe-trash"></i>DELETE</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/div-->
@include('Pengguna.modal.create')

@endsection
