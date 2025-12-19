@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('breadcrumbs', 'Kategori')
@section('second-breadcrumb')
    <li>Edit Kategori</li>
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
            <form action="{{ route('categories.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card card-custom bg-white">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #eee;">
                        <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">
                            <i class="fa fa-pencil-square-o mr-2 text-warning"></i> Edit Kategori: {{ $category->name }}
                        </h5>
                        <div>
                            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-light border shadow-sm mr-2 px-3">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-sm btn-success shadow-sm px-3">
                                <i class="fa fa-save mr-1"></i> Simpan Perubahan
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
                                           value="{{ old('name', $category->name) }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4 pl-lg-4 mt-4 mt-lg-0">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold text-dark small text-uppercase mb-3">Foto Kategori</label>
                                    <div class="mb-3 p-1 border rounded bg-white shadow-sm d-flex align-items-center justify-content-center"
                                         style="height: 200px; overflow: hidden; border: 2px dashed #ddd !important;">
                                        @if ($category->image)
                                            <img src="{{ asset('category_image/' . $category->image) }}" alt="Preview" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="fa fa-image fa-3x mb-2"></i>
                                                <p class="small m-0">Belum ada gambar</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" class="custom-file-input {{ $errors->first('image') ? 'is-invalid' : '' }}" id="customFile">
                                        <label class="custom-file-label text-truncate" for="customFile">Ganti File...</label>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>
                                    <small class="text-danger d-block mt-2 text-left small font-italic">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 text-right">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="fa fa-save"></i> Simpan Perubahan
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
