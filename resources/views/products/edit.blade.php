@extends('layouts.admin')

@section('title', 'Edit Katalog Produk')

@section('breadcrumbs', 'Katalog Produk')

@section('second-breadcrumb')
    <li>Edit Produk</li>
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
            color: #6c757d;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- FORM START (Update) --}}
            <form action="{{ route('products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="card card-custom bg-white">

                    {{-- HEADER: TOMBOL SIMPAN & KEMBALI --}}
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center"
                        style="border-bottom: 1px solid #eee;">
                        <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">
                            <i class="fa fa-pencil-square-o mr-2 text-warning"></i> Edit Produk: {{ $product->name }}
                        </h5>

                        <div>
                            {{-- Tombol Kembali --}}
                            <a href="{{ route('products.index') }}"
                                class="btn btn-sm btn-light border shadow-sm mr-2 px-3">
                                <i class="fa fa-arrow-left mr-1"></i> Kembali
                            </a>

                            {{-- Tombol Simpan --}}
                            <button type="submit" class="btn btn-sm btn-success shadow-sm px-3">
                                <i class="fa fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">

                            {{-- === KOLOM KIRI: INPUT DATA UTAMA === --}}
                            <div class="col-lg-8 pr-lg-5 border-right">

                                {{-- 1. KODE BARANG (READONLY) --}}
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark small text-uppercase">Kode Barang</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary text-white font-weight-bold">#</span>
                                        </div>
                                        {{-- Value diambil dari database --}}
                                        <input type="text" name="code"
                                            class="form-control form-control-lg font-weight-bold"
                                            value="{{ old('code', $product->code) }}" readonly>
                                    </div>
                                    <small class="text-muted font-italic">Kode barang tidak dapat diubah.</small>
                                </div>

                                <div class="row">
                                    {{-- 2. JENIS KATEGORI (DROPDOWN DARI DATABASE) --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Jenis Kategori
                                                <span class="text-danger">*</span></label>

                                            {{-- DROPDOWN DINAMIS --}}
                                            <select name="category_id" id="category_id"
                                                class="form-control {{ $errors->first('category_id') ? 'is-invalid' : '' }}"
                                                required>
                                                <option value="">-- Pilih Jenis Kategori --</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
                                            <small class="text-muted">Pilih kategori produk.</small>
                                        </div>
                                    </div>

                                    {{-- 3. NAMA BARANG --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Nama Barang <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                                value="{{ old('name', $product->name) }}"
                                                placeholder="Contoh: Semen Gresik 50kg" required>
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        </div>
                                    </div>
                                </div> {{-- END ROW --}}

                                <div class="row">
                                    {{-- 4. STOK --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Stok Saat Ini</label>
                                            <div class="input-group">
                                                <input type="number" name="stock"
                                                    class="form-control {{ $errors->first('stock') ? 'is-invalid' : '' }}"
                                                    value="{{ old('stock', $product->stock) }}" min="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-light small">Unit</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">{{ $errors->first('stock') }}</div>
                                        </div>
                                    </div>

                                    {{-- 5. HARGA --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="font-weight-bold text-dark small text-uppercase">Harga Satuan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light font-weight-bold">Rp</span>
                                                </div>
                                                {{-- Tipe Text, Value integer murni tanpa koma agar diprose JS --}}
                                                <input type="text" name="price" id="priceInput"
                                                    class="form-control {{ $errors->first('price') ? 'is-invalid' : '' }}"
                                                    value="{{ old('price', (int)$product->price) }}" min="0">
                                            </div>
                                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 5. DESKRIPSI --}}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark small text-uppercase">Deskripsi</label>
                                    <textarea name="description" rows="5"
                                        class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}" placeholder="Spesifikasi barang..."
                                        required>{{ old('description', $product->description) }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                </div>
                            </div> {{-- END COL KIRI --}}

                            {{-- === KOLOM KANAN: INPUT GAMBAR === --}}
                            <div class="col-lg-4 pl-lg-4 mt-4 mt-lg-0">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold text-dark small text-uppercase mb-3">Foto Produk</label>

                                    {{-- Preview Gambar --}}
                                    <div class="mb-3 p-1 border rounded bg-white shadow-sm d-flex align-items-center justify-content-center"
                                        style="height: 200px; overflow: hidden; border: 2px dashed #ddd !important;">
                                        @if ($product->image)
                                            <img src="{{ asset('product_image/' . $product->image) }}" alt="Preview"
                                                class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="fa fa-image fa-3x mb-2"></i>
                                                <p class="small m-0">Belum ada gambar</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if ($product->image)
                                        <small class="text-success d-block mb-2 font-weight-bold"><i
                                                class="fa fa-check-circle"></i> Gambar saat ini tersedia</small>
                                    @endif

                                    {{-- Input File --}}
                                    <div class="custom-file text-left">
                                        <input type="file" name="image"
                                            class="custom-file-input {{ $errors->first('image') ? 'is-invalid' : '' }}"
                                            id="customFile">
                                        <label class="custom-file-label text-truncate" for="customFile">Ganti
                                            File...</label>
                                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                    </div>

                                    <small class="text-danger d-block mt-2 text-left small font-italic">
                                        *Biarkan kosong jika tidak ingin mengubah gambar.
                                    </small>
                                </div>
                            </div> {{-- END COL KANAN --}}

                        </div> {{-- END ROW --}}
                    </div> {{-- END CARD BODY --}}

                    {{-- === FOOTER KARTU === --}}
                    <div class="card-footer bg-light py-3 text-right">
                        <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="fa fa-save"></i> Simpan Perubahan
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
            // SCRIPT NAMA FILE UPLOAD
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            // AUTO FORMAT CURRENCY (Edit Mode)
            var priceInput = document.getElementById('priceInput');
            if (priceInput && priceInput.value) {
                priceInput.value = formatRupiah(priceInput.value);
            }

            if (priceInput) {
                priceInput.addEventListener('keyup', function(e) {
                    priceInput.value = formatRupiah(this.value);
                });
            }

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        });
    </script>
@endsection
