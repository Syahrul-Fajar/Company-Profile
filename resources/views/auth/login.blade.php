<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Bangunan Sumber Maju</title>

    {{-- Menggunakan Google Fonts (Inter) agar mirip dengan desain --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome untuk Ikon Mata --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #fff;
        }

        /* --- BAGIAN KIRI (DARK SIDE) --- */
        .left-side {
            background-color: #1e1e1e;
            /* Warna dasar gelap */
            /* Simulasi pattern gelombang (optional, warna solid tetap elegan) */
            background-image: radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.03) 2%, transparent 2%, transparent 100%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.03) 4%, transparent 4%, transparent 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            position: relative;
        }

        .brand-logo {
            position: absolute;
            top: 40px;
            left: 40px;
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .logo-icon {
            background-color: #fca311;
            /* Warna Oranye */
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            margin-right: 10px;
            font-weight: 900;
        }

        .welcome-text h1 {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .welcome-text h2 {
            font-weight: 400;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .welcome-desc {
            color: #a0a0a0;
            margin-bottom: 3rem;
            max-width: 400px;
            line-height: 1.6;
        }

        .btn-signup-outline {
            border: 1px solid white;
            color: white;
            padding: 12px 40px;
            background: transparent;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            text-align: center;
            width: fit-content;
        }

        .btn-signup-outline:hover {
            background: white;
            color: #1e1e1e;
        }

        /* --- BAGIAN KANAN (WHITE SIDE) --- */
        .right-side {
            background-color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px;
        }

        .top-nav {
            display: flex;
            justify-content: flex-end;
            gap: 30px;
            margin-bottom: auto;
            /* Push content ke bawah */
        }

        .top-nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: auto;
            /* Center vertikal dan horizontal di flex parent */
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h3 {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 2rem;
        }

        .login-header p {
            color: #666;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: #fafafa;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #333;
            box-shadow: none;
            background-color: #fff;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
        }

        .forgot-link {
            text-decoration: none;
            color: #6c5ce7;
            /* Warna ungu seperti di gambar */
            font-size: 0.9rem;
            float: left;
            margin-top: 10px;
            font-weight: 500;
        }

        .btn-login-black {
            background-color: #1a1a1a;
            color: white;
            width: 100%;
            padding: 14px;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            margin-top: 30px;
            transition: 0.3s;
        }

        .btn-login-black:hover {
            background-color: #333;
        }

        /* Responsive Mobile */
        @media (max-width: 768px) {
            .left-side {
                display: none;
                /* Sembunyikan bagian kiri di HP */
            }

            .right-side {
                padding: 20px;
            }

            .top-nav {
                justify-content: center;
                margin-bottom: 40px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0">

            <div class="col-lg-6 left-side">
                <div class="brand-logo">
                    <span class="logo-icon">TL</span>
                    <div>
                        <div>TB. SUMBER MAJU</div>
                        <div style="font-size: 0.7rem; font-weight: 400; opacity: 0.8;">Toko Bangunan Terlengkap</div>
                    </div>
                </div>

                <div class="welcome-text">
                    <h1>Selamat Datang!</h1>
                    <h2>Toko Bangunan Sumber Maju</h2>
                    <p class="welcome-desc">
                        Akses platform layanan Toko Bangunan Sumber Maju untuk pengalaman penggunaan yang lebih mudah,
                        cepat, dan nyaman.
                    </p>
                </div>
            </div>

            <div class="col-lg-6 right-side">
                <div class="top-nav">
                    <a href="{{ url('/') }}">Home</a>
                </div>

                <div class="login-container">
                    <div class="login-header">
                        <h3>Login ke Akun Anda</h3>
                        <p>Masukkan username dan password</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email / Username:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"
                                required autofocus>

                            @error('email')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password:</label>
                            <div class="password-wrapper">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter your password" required>
                                <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
                            </div>

                            @error('password')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 clearfix">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn-login-black">
                            Login
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Script Sederhana untuk Toggle Password
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
