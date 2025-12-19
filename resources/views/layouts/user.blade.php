<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Bangunan Jaya - Material Lengkap & Murah</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="toko bangunan, material, semen, cat, pipa, murah" name="keywords">
    <meta content="Pusat belanja bahan bangunan terlengkap dan termurah." name="description">

    <link href="{{ asset('user/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('user/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">

    <link href="{{ asset('user/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('user/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">

    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">

    {{-- Custom CSS dari Home --}}
    @yield('header')
</head>

<body>

    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                {{-- Logo Gambar & Teks --}}
                <a href="{{ url('/') }}#hero" class="scrollto" style="display: flex; align-items: center; text-decoration: none;">
                    <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" style="height: 40px; margin-right: 10px; border-radius: 5px;">
                    <h1 style="margin: 0; font-size: 24px; color: #fff; font-weight: 700;">TOKO BANGUNAN JAYA</h1>
                </a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="{{ url('/') }}#hero">Home</a></li>
                    <li><a href="{{ url('/') }}#katalog">Katalog Produk</a></li>
                    <li><a href="{{ url('/') }}#kontak">Lokasi & Kontak</a></li>

                    {{-- Menu Login Admin --}}
                    <li><a href="{{ url('admin') }}" style="color: #f0ad4e;">Login Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section id="hero">
        <div class="hero-container">
            @yield('hero')
        </div>
    </section>
    <main id="main">
        @yield('content')
    </main>

    <footer id="footer"
        style="background: #0b1320; color: #fff; padding-top: 60px; font-family: 'Open Sans', sans-serif;">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6 mb-5">
                    <div class="d-flex align-items-center mb-4">
                        {{-- Icon Logo Gambar --}}
                        <img src="{{ asset('images/logo-icon.jpg') }}" alt="Logo" style="height: 45px; margin-right: 15px; border-radius: 8px;">
                        <h4 class="font-weight-bold m-0" style="letter-spacing: 1px; color: #fff;">TOKO BANGUNAN JAYA
                        </h4>
                    </div>
                    <p style="color: #a0a6b5; line-height: 1.8; font-size: 0.95rem;">
                        Penyedia material bangunan berkualitas tinggi dengan harga terbaik sejak 2010. Kami melayani
                        pengiriman cepat dan konsultasi kebutuhan proyek Anda.
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 mb-5">
                    <h5 class="mb-4 font-weight-bold" style="color: #fff;">Hubungi Kami</h5>
                    <ul class="list-unstyled" style="color: #a0a6b5; font-size: 0.95rem;">
                        <li class="mb-3 d-flex">
                            <i class="fa fa-map-marker text-warning mr-3 mt-1" style="font-size: 1.2rem;"></i>
                            <span>Jl. Raya Industri No. 123, Jakarta Timur</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fa fa-phone text-warning mr-3 mt-1" style="font-size: 1.2rem;"></i>
                            <span>
                                <span class="text-white">{{ $admin->phone ?? \App\User::first()->phone ?? '0812-3456-7890' }} (WhatsApp)</span>
                            </span>
                        </li>
                        <li class="mb-3 d-flex">
                            <i class="fa fa-clock-o text-warning mr-3 mt-1" style="font-size: 1.2rem;"></i>
                            <span>
                                Senin - Sabtu: 07.00 - 17.00<br>
                                Minggu: 08.00 - 14.00
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5">
                    <h5 class="mb-4 font-weight-bold" style="color: #fff;">Kategori Produk</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Semen &
                                Perekat</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Pasir &
                                Batu</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Besi &
                                Baja</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Cat &
                                Pelapis</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Keramik &
                                Lantai</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Pipa &
                                Sanitasi</a></li>
                        <li class="mb-2"><a href="#" style="color: #a0a6b5; text-decoration: none;">Atap &
                                Plafon</a></li>
                    </ul>
                </div>

            </div>

            <hr style="border-top: 1px solid #1f293a; margin-bottom: 25px;">

            <div class="row pb-4">
                <div class="col-md-12 text-center small" style="color: #6c757d;">
                    &copy; 2010 - {{ date('Y') }} <strong>Toko Bangunan Jaya</strong>. Hak Cipta Dilindungi. <br>
                </div>
            </div>
        </div>
    </footer><a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="{{ asset('user/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/lib/jquery/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('user/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('user/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('user/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('user/lib/superfish/hoverIntent.js') }}"></script>
    <script src="{{ asset('user/lib/superfish/superfish.min.js') }}"></script>

    <script src="{{ asset('user/contactform/contactform.js') }}"></script>

    <script src="{{ asset('user/js/main.js') }}"></script>

</body>

</html>
