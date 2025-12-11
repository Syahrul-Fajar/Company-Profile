@extends('layouts.admin')

@section('title', 'Tambah Katalog Baru')

@section('breadcrumbs', 'Katalog Produk')

@section('second-breadcrumb')
    <li>Tambah Baru</li>
@endsection

@section('css')
    <style>
        .form-control:focus {
            border-color: #f39c12;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
        }

        .btn-success {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        .btn-success:hover {
            background-color: #f39c12;
            border-color: #f39c12;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid #eef2f7;
            overflow: hidden;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- FORM START --}}
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card card-custom bg-white">

                    {{-- HEADER: TOMBOL SIMPAN & KEMBALI DI ATAS --}}
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
                        style="border-bottom: 1px solid #eee;">
                        <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">
                            <i class="fa fa-plus-square mr-2 text-warning"></i> Form Tambah Produk
                        </h5>

                        <div>
                            {{-- Tombol Kembali --}}
                            <a href="{{ route('categories.index') }}"
                                class="btn btn-sm btn-light border shadow-sm mr-2 px-3">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali
                            </a>

                            {{-- Tombol Simpan --}}
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

                            {{-- === KOLOM KIRI: INPUT DATA UTAMA === --}}
                            <div class="col-lg-8 pr-lg-5 border-right">

                                {{-- 1. KODE BARANG (OTOMATIS) --}}
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark small text-uppercase">Kode Barang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary text-white font-weight-bold">#</span>
                                        </div>
                                        {{-- Input Readonly, diisi oleh JS di bawah --}}
                                        <input type="text" name="code" id="autoCode"
                                            class="form-control form-control-lg font-weight-bold text-secondary" readonly
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- 2. JENIS KATEGORI (DROPDOWN DARI DATABASE) --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Jenis Kategori
                                                <span class="text-danger">*</span></label>

                                            {{-- DROPDOWN DINAMIS --}}
                                            <select name="product_group_id" id="product_group_id"
                                                class="form-control {{ $errors->first('product_group_id') ? 'is-invalid' : '' }}"
                                                required>
                                                <option value="">-- Pilih Jenis Kategori --</option>

                                                {{-- LOOPING DATA DARI CONTROLLER --}}
                                                @isset($productGroups)
                                                    @foreach ($productGroups as $group)
                                                        <option value="{{ $group->id }}"
                                                            {{ old('product_group_id') == $group->id ? 'selected' : '' }}>
                                                            {{ $group->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset

                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('product_group_id') }}</div>
                                            <small class="text-muted">Kelompok barang (Misal: Material, Pipa &
                                                Sanitasi).</small>
                                        </div>
                                    </div>

                                    {{-- 3. NAMA BARANG --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Nama Barang <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                                value="{{ old('name') }}" placeholder="Contoh: Semen Gresik 50kg"
                                                required>
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        </div>
                                    </div>
                                </div> {{-- END ROW --}}

                                {{-- 4. STOK --}}
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark small text-uppercase">Stok Awal</label>
                                    <input type="number" name="stock"
                                        class="form-control {{ $errors->first('stock') ? 'is-invalid' : '' }}"
                                        value="{{ old('stock', 0) }}" min="0" placeholder="0">
                                    <div class="invalid-feedback">{{ $errors->first('stock') }}</div>
                                </div>

                                {{-- 5. DESKRIPSI --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark small text-uppercase">Deskripsi</label>
                                    <textarea name="description" rows="5"
                                        class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}" placeholder="Spesifikasi barang..."
                                        required>{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                </div>
                            </div> {{-- END COL KIRI --}}

                            {{-- === KOLOM KANAN: INPUT GAMBAR === --}}
                            <div class="col-lg-4 pl-lg-4 mt-4 mt-lg-0">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold text-dark small text-uppercase mb-3">Foto Produk <span
                                            class="text-danger">*</span></label>

                                    {{-- Preview Placeholder --}}
                                    <div class="mb-3 p-4 border rounded bg-light text-muted d-flex align-items-center justify-content-center"
                                        style="height: 200px; border: 2px dashed #ddd !important;">
                                        <div class="text-center">
                                            <i class="fa fa-image fa-3x mb-2 text-secondary"></i>
                                            <p class="small m-0 text-secondary">Preview Gambar</p>
                                        </div>
                                    </div>

                                    {{-- Input File --}}
                                    <div class="custom-file text-left">
                                        <input type="file" name="image"
                                            class="custom-file-input {{ $errors->first('image') ? 'is-invalid' : '' }}"
                                            id="customFile" required>
                                        <label class="custom-file-label text-truncate" for="customFile">Pilih
                                            File...</label>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>

                                    <small class="text-muted d-block mt-2 text-left small font-italic">Format: JPG, PNG.
                                        Max: 2MB.</small>
                                </div>
                            </div> {{-- END COL KANAN --}}

                        </div> {{-- END ROW --}}
                    </div> {{-- END CARD BODY --}}

                    {{-- === FOOTER KARTU (TOMBOL SIMPAN BAWAH) === --}}
                    <div class="card-footer bg-light py-3 text-right">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="fa fa-save"></i> Simpan Data
                        </button>
                    </div>

                </div>
            </form>
            {{-- FORM END --}}

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // 1. GENERATE KODE OTOMATIS (PRD-YYYYMMDD-XXX)
            let today = new Date();
            let dateStr = today.getFullYear() +
                String(today.getMonth() + 1).padStart(2, '0') +
                String(today.getDate()).padStart(2, '0');
            let randomNum = Math.floor(100 + Math.random() * 900);

            document.getElementById('autoCode').value = 'PRD-' + dateStr + '-' + randomNum;


            // 2. SCRIPT NAMA FILE UPLOAD
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
