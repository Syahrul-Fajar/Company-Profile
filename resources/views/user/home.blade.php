@extends('layouts.user')

@section('header')
    <style>
        /* --- FONTS & VARIABLES --- */
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');

        :root {
            --primary-color: #F26522;
            /* Orange Utama */
            --primary-dark: #d35400;
            --navy-color: #2c3e50;
            /* Navy Blue */
            --text-grey: #555555;
        }

        body {
            font-family: 'Nunito', sans-serif;
            overflow-x: hidden;
        }

        /* --- HERO SECTION --- */
        #hero {
            width: 100%;
            height: 100vh;
            background: url('{{ asset('user/images/hero-bg.png') }}') center center no-repeat;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start !important;
            padding-left: 0;
        }

        #hero::before {
            content: "";
            background: linear-gradient(to right, rgba(44, 62, 80, 0.9) 0%, rgba(44, 62, 80, 0.6) 50%, rgba(44, 62, 80, 0.1) 100%);
            position: absolute;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        .hero-container {
            position: relative;
            z-index: 2;
            width: 100%;
            /* Removed extra padding to align with navbar keyline */
        }

        .hero-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 20px;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            border-radius: 30px;
            display: inline-block;
            margin-bottom: 20px;
            letter-spacing: 2px;
            box-shadow: 0 4px 10px rgba(242, 101, 34, 0.4);
        }

        #hero h1 {
            color: #ffffff;
            font-size: 58px;
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            margin-bottom: 20px;
            text-align: left;
        }

        #hero h2 {
            color: #ecf0f1;
            margin-bottom: 35px;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.6;
            max-width: 600px;
            text-align: left;
        }

        .btn-custom {
            font-weight: 700;
            font-size: 16px;
            padding: 12px 35px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            border: none;
        }

        .btn-orange {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(242, 101, 34, 0.4);
        }

        .btn-orange:hover {
            background-color: var(--primary-dark);
            color: white;
            transform: translateY(-3px);
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: #fff;
            margin-left: 15px;
        }

        .btn-outline-light:hover {
            background: #fff;
            color: var(--navy-color);
        }

        /* --- SECTION TENTANG --- */
        .about-img-box {
            position: relative;
            padding: 15px;
        }

        .about-bg-shape {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 20px;
            z-index: -1;
        }

        /* --- SECTION TITLE --- */
        .section-title {
            font-size: 32px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--navy-color);
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            margin: 10px auto 0;
            border-radius: 2px;
        }

        /* --- PRODUCT CARD --- */
        .product-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            overflow: hidden;
            height: 100%;
            border: 1px solid #f1f1f1;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .product-img-wrapper {
            height: 220px;
            overflow: hidden;
            background: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-details {
            padding: 25px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title {
            color: var(--navy-color);
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 10px;
        }

        /* --- CONTACT BOX --- */
        .contact-box {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            height: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            border-bottom: 4px solid transparent;
        }

        .contact-box:hover {
            border-bottom: 4px solid var(--primary-color);
            transform: translateY(-5px);
        }

        .contact-box i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        /* --- MOBILE --- */
        @media (max-width: 768px) {
            #hero {
                justify-content: center !important;
                text-align: center !important;
            }

            #hero h1 {
                font-size: 36px;
                text-align: center;
            }

            #hero h2 {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }

            .hero-btns {
                justify-content: center;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .btn-outline-light {
                margin-left: 0;
            }
            .btn-outline-light {
                margin-left: 0;
            }

            /* Fix Mobile Layout Overlap */
            .hero-content-left {
                text-align: center !important;
                margin-left: 0 !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
                padding-top: 120px; /* Tambah jarak atas agar tidak tertutup navbar */
            }

            /* Kecilkan Judul Hero di Mobile */
            #hero h1 {
                font-size: 28px !important; /* Ukuran font lebih kecil */
                line-height: 1.2;
            }

            /* Kecilkan Logo & Judul Navbar di Mobile */
            #logo img {
                height: 30px !important;
            }
            #logo h1 {
                font-size: 16px !important;
            }

            /* Kecilkan Logo About di Mobile */
            .about-logo {
                max-width: 180px !important;
                max-height: auto !important;
                margin: 0 auto;
                display: block;
            }
            .about-img-box {
                text-align: center;
            }
        }

        /* Desktop specific styles */
        @media (min-width: 769px) {
            .hero-content-left {
                text-align: left;
                padding-left: 0;
                margin-left: -12px;
            }
        }
    </style>
@endsection

@section('hero')
    <div class="container hero-container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-10 hero-content-left">
                <div class="wow fadeInDown">
                    <span class="hero-badge">Material Konstruksi Terlengkap</span>
                </div>
                <h1 class="wow fadeInDown" data-wow-delay="0.1s">
                    Bangun Masa Depan<br>
                    <span style="color: var(--primary-color);">Kokoh & Terpercaya</span>
                </h1>
                <h2 class="wow fadeInUp" data-wow-delay="0.2s">
                    Pusat belanja bahan bangunan terbaik dengan harga kompetitif.
                    Konsultasikan kebutuhan proyek Anda bersama kami.
                </h2>
                <div class="hero-btns wow fadeInUp" data-wow-delay="0.4s">
                    <a href="https://wa.me/{{ $admin->phone ?? '628123456789' }}" target="_blank" class="btn-custom btn-orange">
                        <i class="fa fa-whatsapp mr-2"></i> Hubungi Kami
                    </a>
                    <a href="#katalog" class="btn-custom btn-outline-light scrollto">
                        Lihat Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- === 2. SECTION KATALOG === --}}
    <section id="katalog" class="py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5 wow fadeInUp">
                <h3 class="section-title">Kategori Produk</h3>
                <p class="text-muted mt-2">Temukan berbagai material berkualitas untuk proyek Anda</p>
                
                {{-- FORM PENCARIAN --}}
                <div class="row justify-content-center mt-4">
                    <div class="col-md-6">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="input-group mb-3 shadow-sm rounded-pill overflow-hidden" style="border: 1px solid #ddd;">
                                <input type="text" name="search" class="form-control border-0" placeholder="Cari barang atau kategori..." value="{{ request('search') }}" style="padding-left: 20px; height: 50px;" required>
                                <div class="input-group-append">
                                    <button class="btn btn-warning text-white px-4" type="submit" style="background: var(--primary-color);">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- LOGIC BARU: Mengambil data berdasarkan Grup (categories adalah array grouping dari controller) --}}
                @foreach ($products as $groupName => $items)
                    @php
                        // Ambil item pertama sebagai perwakilan foto & link
                        $firstItem = $items->first();

                        // Gabungkan nama barang menjadi satu string dipisah koma
                        $productList = $items->pluck('name')->join(', ');
                    @endphp

                    <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.1 }}s">
                        <a href="{{ url('product/' . $firstItem->id) }}" style="text-decoration: none;">
                            <div class="product-card h-100">
                                <div class="product-img-wrapper">
                                    {{-- Foto Perwakilan --}}
                                    <img src="{{ asset('product_image/' . $firstItem->image) }}" alt="{{ $groupName }}"
                                        onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300?text=No+Image';">
                                </div>
                                <div class="product-details">
                                    {{-- 1. JUDUL = Nama Kategori (Group) --}}
                                    <h4 class="product-title">{{ $groupName }}</h4>

                                    {{-- 2. DESKRIPSI = List nama barang didalamnya --}}
                                    <p class="text-muted small">
                                        {{ Str::limit($productList, 80) }}
                                    </p>

                                    <h6 class="text-success font-weight-bold mb-3">
                                        <small class="text-muted font-weight-normal">Mulai</small> 
                                        Rp. {{ number_format($firstItem->price ?? 0, 0, ',', '.') }}
                                    </h6>

                                    <span class="btn btn-sm font-weight-bold mt-2"
                                        style="color: var(--primary-color); border: 1px solid var(--primary-color); border-radius: 20px; padding: 5px 20px;">
                                        Lihat {{ count($items) }} Produk
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                @if ($products->isEmpty())
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada data kategori.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- === 1. SECTION TENTANG KAMI (SESUAI BACKEND) === --}}
    <section id="tentang" class="py-5">
        <div class="container py-4">

            {{-- Cek apakah variabel $about ada datanya --}}
            @if ($about)
                <div class="row align-items-center">

                    {{-- GAMBAR (Sesuai backend: about_image/) --}}
                    <div class="col-lg-6 mb-4 mb-lg-0 wow fadeInLeft">
                        <div class="about-img-box">
                            <div class="about-bg-shape" style="top:0; left:0; background: var(--primary-color);"></div>
                            <div class="about-bg-shape" style="bottom:0; right:0; background: var(--navy-color);"></div>

                            <img src="{{ asset('about_image/' . $about->image) }}" alt="Tentang Toko"
                                class="img-fluid rounded shadow-lg about-logo"
                                onerror="this.src='https://via.placeholder.com/600x400?text=No+Image'">
                        </div>
                    </div>

                    {{-- TEKS (Sesuai backend: kolom CAPTION) --}}
                    <div class="col-lg-6 pl-lg-5 wow fadeInRight">
                        <h6
                            style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">
                            Tentang Toko
                        </h6>
                        <h2 style="font-weight: 800; color: var(--navy-color); margin-bottom: 20px; font-size: 2.5rem;">
                            {{ $about->judul ?? 'Informasi Toko' }} {{-- Fallback judul jika tidak ada kolom judul --}}
                        </h2>

                        {{-- DISINI KUNCINYA: Gunakan {!! !!} dan panggil kolom 'caption' --}}
                        <div style="color: var(--text-grey); line-height: 1.8; margin-bottom: 25px; font-size: 1.1rem;">
                            {!! $about->caption !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <h3 class="text-muted">Informasi toko belum tersedia.</h3>
                </div>
            @endif

        </div>
    </section>
    {{-- === 3. CTA & FOOTER INFO === --}}
    <section class="py-5 wow fadeIn" style="background: linear-gradient(to right, #2c3e50, #34495e);">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <h3 class="text-white font-weight-bold mb-3">Butuh Penawaran Khusus Proyek?</h3>
                    <p class="text-white mb-4" style="opacity: 0.9;">
                        Kami melayani pembelian partai besar. Hubungi kami untuk penawaran terbaik.
                    </p>
                    <a class="btn btn-lg shadow rounded-pill px-5 font-weight-bold" href="https://wa.me/{{ $admin->phone ?? '628123456789' }}"
                        target="_blank" style="background: #25d366; color: #fff;">
                        <i class="fa fa-whatsapp mr-2"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="kontak" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5 wow fadeInUp">
                <h3 class="section-title">Lokasi & Kontak</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInLeft">
                    <div class="contact-box">
                        <i class="fa fa-map-marker"></i>
                        <h5 class="font-weight-bold mb-2">Alamat</h5>
                        <p class="text-muted">Jl. Raya Industri No. 12<br>Semarang, Jawa Tengah</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp">
                    <div class="contact-box">
                        <i class="fa fa-phone"></i>
                        <h5 class="font-weight-bold mb-2">Telepon</h5>
                        <p class="text-muted">+{{ $admin->phone ?? '62 812 3456 7890' }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 wow fadeInRight">
                    <div class="contact-box">
                        <i class="fa fa-clock-o"></i>
                        <h5 class="font-weight-bold mb-2">Jam Buka</h5>
                        <p class="text-muted">Senin - Sabtu: 08.00 - 17.00<br>Minggu: Libur</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 wow zoomIn">
                    <div class="rounded overflow-hidden shadow-sm"
                        style="height: 400px; width: 100%; border-radius: 15px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253.47803909908947!2d110.40522803006817!3d-6.966809552905428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f5003bd1fb73%3A0x891d13efbfbfc30b!2sToko%20besi%20dan%20bahan%20bangunan%20Sumber%20Maju!5e1!3m2!1sid!2sid!4v1764999341779!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
