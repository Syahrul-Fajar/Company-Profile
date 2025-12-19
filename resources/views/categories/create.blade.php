@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')
@section('breadcrumbs', 'Kategori')
@section('second-breadcrumb')
    <li>Tambah Baru</li>
@endsection

@section('css')
    <style>
        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
        }
        .btn-success { background-color: #2c3e50; border-color: #2c3e50; }
        .btn-success:hover { background-color: #f39c12; border-color: #f39c12; }
        .card-custom {
            border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); border: 1px solid #eef2f7; overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-custom bg-white">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #eee;">
                        <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">
                            <i class="fa fa-plus-square mr-2 text-warning"></i> Form Tambah Kategori
                        </h5>
                        <div>
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light border shadow-sm mr-2 px-3">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-success shadow-sm px-3">
                                <i class="fa fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-8 pr-lg-5 border-right">
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark small text-uppercase">Nama Kategori <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                           value="{{ old('name') }}" placeholder="Contoh: Material Bangunan" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4 pl-lg-4 mt-4 mt-lg-0">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold text-dark small text-uppercase mb-3">Foto Kategori</label>
                                    <div class="mb-3 p-4 border rounded bg-light text-muted d-flex align-items-center justify-content-center"
                                         style="height: 200px; border: 2px dashed #ddd !important;">
                                        <div class="text-center">
                                            <i class="fa fa-image fa-3x mb-2 text-secondary"></i>
                                            <p class="small m-0 text-secondary">Preview Gambar</p>
                                        </div>
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" class="custom-file-input {{ $errors->first('image') ? 'is-invalid' : '' }}" id="customFile">
                                        <label class="custom-file-label text-truncate" for="customFile">Pilih File...</label>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                    <small class="text-muted d-block mt-2 text-left small font-italic">Format: JPG, PNG. Maks: 2MB.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 text-right">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="fa fa-save"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
