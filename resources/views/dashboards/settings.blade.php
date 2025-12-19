@extends('layouts.admin')

@section('breadcrumbs', 'Pengaturan Profil')

@section('content')
<div class="row">
    <div class="col-lg-12">
        
        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Notifikasi Error --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- KARTU 1: FOTO & DATA DIRI --}}
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body text-center p-5">
                            <div class="mb-3 position-relative d-inline-block">
                                {{-- Preview Foto --}}
                                @if(Auth::user()->avatar)
                                    <img id="avatarPreview" src="{{ asset('avatars/'.Auth::user()->avatar) }}" class="rounded-circle border" style="width: 120px; height: 120px; object-fit: contain; border: 4px solid #f39c12 !important;">
                                @else
                                    <img id="avatarPreview" src="{{ asset('ElaAdmin/images/admin.jpg') }}" class="rounded-circle border" style="width: 120px; height: 120px; object-fit: contain; border: 4px solid #f39c12 !important;">
                                @endif
                                
                                {{-- Ikon Kamera --}}
                                <label for="avatarUpload" class="position-absolute" style="bottom: 0; right: 0; background: #2c3e50; color: #fff; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <input type="file" name="avatar" id="avatarUpload" style="display: none;">
                            </div>
                            
                            <h4 class="font-weight-bold text-dark">{{ Auth::user()->name }}</h4>
                            <p class="text-muted">Administrator</p>
                        </div>
                    </div>
                </div>

                {{-- KARTU 2: FORM EDIT --}}
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h5 class="font-weight-bold text-dark"><i class="fa fa-cogs mr-2 text-warning"></i> Edit Informasi</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            
                            {{-- Nama & Email --}}
                            <div class="form-group">
                                <label class="font-weight-bold small text-muted">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small text-muted">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold small text-muted">Nomor WhatsApp (Contoh: 628123456789)</label>
                                <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="628xxxxxxxxxx">
                            </div>

                            <hr class="my-4">
                            <h6 class="font-weight-bold text-danger mb-3"><i class="fa fa-lock mr-1"></i> Ganti Password</h6>

                            {{-- Ganti Password --}}
                            <div class="form-group">
                                <label class="font-weight-bold small text-muted">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-control" placeholder="Isi jika ingin mengganti password">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small text-muted">Password Baru</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small text-muted">Konfirmasi Password Baru</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-warning text-white font-weight-bold px-4 py-2" style="background: #f39c12; border: none; border-radius: 50px;">
                                    <i class="fa fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('avatarUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection