@extends('layouts.admin')

@section('title', 'Profil Toko')

@section('breadcrumbs', 'Profil Toko')

@section('second-breadcrumb')
    <li>Detail Profil</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    {{-- Notifikasi Sukses Update --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Header Judul & Tombol (Logika Cek Data) --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                        <h3 class="text-dark font-weight-bold m-0">Informasi Toko</h3>

                        {{-- CEK DATA: Jika ada data, tombol EDIT. Jika tidak, tombol BUAT BARU --}}
                        @if (count($abouts) > 0)
                            <a href="{{ route('abouts.edit', [$abouts[0]->id]) }}"
                                class="btn btn-warning text-dark font-weight-bold px-4 shadow-sm">
                                <i class="fa fa-pencil"></i> Edit Profil
                            </a>
                        @else
                            {{-- Pastikan route 'abouts.create' ada di web.php Anda --}}
                            <a href="{{ route('abouts.create') }}"
                                class="btn btn-primary text-white font-weight-bold px-4 shadow-sm">
                                <i class="fa fa-plus"></i> Buat Profil Baru
                            </a>
                        @endif
                    </div>

                    <hr>

                    {{-- TAMPILAN KONTEN --}}
                    <div class="row mt-4">
                        @if (count($abouts) > 0)
                            {{-- JIKA DATA ADA: Tampilkan Foto & Deskripsi --}}

                            {{-- Kolom Kiri: Foto --}}
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light text-center py-2">
                                        <strong class="text-muted small">FOTO / LOGO TOKO</strong>
                                    </div>
                                    <img src="{{ asset('about_image/' . $abouts[0]->image) }}" class="card-img-top"
                                        alt="Foto Profil Toko" style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                            </div>

                            {{-- Kolom Kanan: Deskripsi --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="font-weight-bold text-uppercase text-secondary"
                                        style="letter-spacing: 1px;">Deskripsi & Sejarah Toko:</label>
                                    <div class="p-4 border rounded bg-light"
                                        style="min-height: 250px; background-color: #f8f9fa;">
                                        {{-- Menampilkan format HTML dari text editor --}}
                                        {!! $abouts[0]->caption !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- JIKA DATA KOSONG: Tampilkan Pesan --}}
                            <div class="col-md-12 text-center py-5">
                                <div class="text-muted">
                                    <i class="fa fa-info-circle fa-3x mb-3 text-secondary"></i>
                                    <h4>Belum ada data profil toko.</h4>
                                    <p>Silakan klik tombol <b>"Buat Profil Baru"</b> di pojok kanan atas untuk mengisi
                                        informasi toko Anda.</p>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
