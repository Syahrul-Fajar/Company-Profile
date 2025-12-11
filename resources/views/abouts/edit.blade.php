@extends('layouts.admin')

@section('title', 'Edit Profil Toko')

@section('breadcrumbs', '')

@section('second-breadcrumb')
    <li>Edit Profil Toko</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h3 class="text-center mt-3 mb-5">Edit Profil Toko</h3>

                    <div class="row">
                        {{-- Kolom Kiri: Tampilan Gambar Saat Ini --}}
                        <div class="col-md-3 mt-4">
                            <div class="card shadow">
                                <div class="card-header py-2 text-center bg-light">
                                    <small class="font-weight-bold">Foto Profil Saat Ini</small>
                                </div>
                                <img src="{{ asset('about_image/' . $about->image) }}" class="card-img-top" alt="image"
                                    style="object-fit: cover; height: 200px;">
                            </div>
                        </div>

                        {{-- Kolom Kanan: Form Edit --}}
                        <div class="col-md-9">
                            <form action="{{ route('abouts.update', [$about->id]) }}" method="POST" class="d-inline"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="content" class="font-weight-bold">Deskripsi Profil Toko:</label>
                                    <p class="text-muted small mb-2">Tuliskan sejarah toko, visi misi, atau alamat lengkap
                                        toko bangunan Anda di sini.</p>
                                    <textarea name="caption" id="content" rows="10" class="form-control ckeditor">{{ $about->caption }}</textarea>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <label class="font-weight-bold">Ganti Foto Profil:</label>
                                        <input type="file" name="image" class="form-control-file border p-2">
                                        <small class="font-italic text-danger">*Kosongkan jika tidak ingin mengubah foto
                                            profil toko.</small>
                                    </div>
                                    <div class="col-md-5 text-right align-self-center">
                                        <button type="submit" class="btn btn-success btn-lg px-5">
                                            <i class="fa fa-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- ckeditor --}}
    <script src="/templateEditor/ckeditor/ckeditor.js"></script>
    <script src="/templateEditor/ckeditor/config.js"></script>
    <script>
        // Konfigurasi CKEditor (Tanpa Upload Gambar Drag & Drop agar tidak error)
        CKEDITOR.replace('content', {
            height: 250,

            // Toolbar disederhanakan
            toolbarGroups: [{
                    "name": "basicstyles",
                    "groups": ["basicstyles"]
                },
                {
                    "name": "links",
                    "groups": ["links"]
                },
                {
                    "name": "paragraph",
                    "groups": ["list", "blocks"]
                },
                {
                    "name": "styles",
                    "groups": ["styles"]
                }
            ],

            // Hapus tombol-tombol yang tidak diperlukan termasuk 'Image' (upload gambar via tombol toolbar dimatikan)
            removeButtons: 'Strike,Subscript,Superscript,Anchor,Specialchar,Image,Print,Save,NewPage,Source,Table,Iframe,PageBreak,CreateDiv,Flash,Smiley'
        });
    </script>
@endsection
