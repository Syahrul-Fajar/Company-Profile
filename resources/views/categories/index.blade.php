@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('breadcrumbs', 'Kategori')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">

                {{-- Header Card --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">Daftar Kategori</h5>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success shadow-sm rounded-pill px-3">
                        <i class="fa fa-plus mr-1"></i> Tambah Kategori
                    </a>
                </div>

                <div class="card-body">
                    {{-- Alert Sukses --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tabel Data --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" style="vertical-align: middle;">
                            <thead class="text-white" style="background-color: #2c3e50;">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 15%">Foto</th>
                                    <th class="text-left" style="width: 30%">Nama Kategori</th>
                                    <th class="text-left" style="width: 30%">Slug</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td class="align-middle">{{ $index + 1 }}</td>
                                        
                                        <td class="align-middle">
                                            @if ($category->image)
                                                <img src="{{ asset('category_image/' . $category->image) }}" alt="Foto"
                                                     class="img-thumbnail rounded shadow-sm"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="badge badge-secondary">Tidak ada gambar</span>
                                            @endif
                                        </td>

                                        <td class="text-left align-middle font-weight-bold text-dark">
                                            {{ $category->name }}
                                        </td>

                                        <td class="text-left align-middle text-secondary">
                                            {{ $category->slug }}
                                        </td>

                                        <td class="align-middle">
                                            <div class="btn-group" role="group">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('categories.edit', [$category->id]) }}"
                                                    class="btn btn-sm btn-warning text-white" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form id="delete-form-{{ $category->id }}"
                                                      action="{{ route('categories.destroy', [$category->id]) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fa fa-search fa-3x mb-3"></i><br>
                                            Data kategori tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Anda akan menghapus kategori: " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
