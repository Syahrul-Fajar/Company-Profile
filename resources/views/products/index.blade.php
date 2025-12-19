@extends('layouts.admin')

@section('title', 'Daftar Katalog')
@section('breadcrumbs', 'Katalog Produk')

@section('content')
    {{-- TAMBAHKAN LIBRARY SWEETALERT (Dipindahkan ke section 'scripts' agar lebih rapi) --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">

                {{-- Header Card --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold" style="color: #2c3e50;">Daftar Produk</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-success shadow-sm rounded-pill px-3">
                        <i class="fa fa-plus mr-1"></i> Tambah Produk Baru
                    </a>
                </div>

                <div class="card-body">
                    {{-- Alert Sukses (Bawaan Laravel) --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle mr-1"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- === BAGIAN FORM PENCARIAN BARU === --}}
                    <div class="mb-3">
                        <form action="{{ route('products.index') }}" method="GET" class="form-inline justify-content-start">
                            {{-- Filter Kategori --}}
                            <div class="input-group mr-2">
                                <select name="category_id" class="form-control custom-select" onchange="this.form.submit()">
                                    <option value="">Kategori: Semua</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Barang ..." 
                                    value="{{ request('search') }}" style="border-right: none;">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" style="background-color: #f8f9fa; border-left: none;">
                                        <i class="fa fa-search text-secondary"></i>
                                    </button>
                                </div>
                                {{-- Tombol Reset Search --}}
                                @if(request('search'))
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    {{-- === AKHIR FORM PENCARIAN === --}}


                    {{-- Tabel Data --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" style="vertical-align: middle;">
                            <thead class="text-white" style="background-color: #2c3e50;">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 8%">Foto</th>
                                    <th style="width: 15%">Kode</th>
                                    <th class="text-left" style="width: 20%">Nama Barang</th>
                                    <th style="width: 15%">Kategori</th>
                                    <th style="width: 12%">Harga</th>
                                    <th style="width: 8%">Stok</th>
                                    <th style="width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $index => $product)
                                    <tr>
                                        <td class="align-middle">{{ $products->firstItem() + $index }}</td> 
                                        
                                        <td class="align-middle">
                                            @if ($product->image)
                                                <img src="{{ asset('product_image/' . $product->image) }}" alt="Foto"
                                                     class="img-thumbnail rounded shadow-sm"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="badge badge-secondary">Tidak ada gambar</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-secondary font-weight-bold">
                                            {{ $product->code ?? '-' }}
                                        </td>

                                        <td class="text-left align-middle font-weight-bold text-dark">
                                            {{ $product->name }}
                                        </td>

                                        <td class="align-middle">
                                            <span class="badge badge-info">{{ $product->group ?? 'Umum' }}</span>
                                        </td>

                                        <td class="align-middle font-weight-bold">
                                            Rp. {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                        </td>

                                        <td class="align-middle">
                                            <span
                                                class="badge {{ ($product->stock ?? 0) > 0 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>

                                        <td class="align-middle">
                                            <div class="btn-group" role="group">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('products.edit', [$product->id]) }}"
                                                    class="btn btn-sm btn-warning text-white" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                {{-- Tombol Hapus dengan SweetAlert --}}
                                                <form id="delete-form-{{ $product->id }}"
                                                      action="{{ route('products.destroy', [$product->id]) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fa fa-search fa-3x mb-3"></i><br>
                                            Data produk tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (Menggunakan link yang benar) --}}
                    <div class="mt-3">
                        {{ $products->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- SCRIPT KHUSUS UNTUK POPUP --}}
@section('scripts')
    {{-- Tambahkan SweetAlert library di sini jika belum ada di layout admin --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Anda akan menghapus data: " + name,
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