<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('/assets/images/background/preview1.webp') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Dark overlay */
            z-index: 1;
        }

        .card-container {
            position: relative;
            width: 400px;
            max-width: 100%;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            position: absolute;
            width: 100%;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
        }

        .card-front {
            z-index: 2;
        }

        .card-back {
            transform: translateX(100%);
            opacity: 0;
        }

        .card-container.flipped .card-front {
            transform: translateX(-100%);
            opacity: 0;
        }

        .card-container.flipped .card-back {
            transform: translateX(0);
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="card-container" id="card-container">
        <div class="card bg-white card-front p-4 rounded shadow">
            <div class="text-center mb-4">
                <h4>Layanan Pengaduan Masyarakat</h4>
            </div>
            <h2 class="text-center mb-3 ">Login</h2>
            @error('auth_fail')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="login-nik" class="form-label ">NIK</label>
                    <input type="text" class="form-control" id="login-nik" name="nik"
                        placeholder="Masukkan NIK anda">
                </div>
                <div class="mb-3">
                    <label for="login-password" class="form-label ">Kata sandi</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="••••••••">
                </div>
                <div class="d-grid my-4">
                    <button type="submit" class="btn btn-primary ">Masuk</button>
                </div>
                <div class="text-center">
                    <a href="#" class="text-decoration-none " onclick="toggleForms()">Belum punya
                        akun?</a>
                </div>
            </form>
        </div>
        <div class="card bg-white card-back p-4 rounded shadow">
            <div class="text-center mb-4">
                <h4>Layanan Pengaduan Masyarakat</h4>
            </div>
            <h2 class="text-center mb-4 ">Pendaftaran Akun</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label ">Nama Lengkap</label>
                    <input type="text"
                        class="form-control @error('name')
                            is-invalid
                        @enderror"
                        id="name" name="name" placeholder="Nama lengkap sesuai ktp" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="register-nik" class="form-label ">NIK</label>
                    <input type="text"
                        class="form-control @error('nik')
                            is-invalid
                        @enderror"
                        id="register-nik" name="nik" placeholder="NIK sesuai ktp" value="{{ old('nik') }}">
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label ">Email</label>
                    <input type="email"
                        class="form-control @error('email')
                            is-invalid
                        @enderror"
                        id="email" name="email" placeholder="name@gmail.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label ">Alamat</label>
                    <textarea name="alamat" id="alamat"
                        class="form-control @error('alamat')
                            is-invalid
                        @enderror"
                        placeholder="Isi sesuai alamat di ktp">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="register-password" class="form-label ">Password</label>
                    <input type="password"
                        class="form-control @error('password')
                            is-invalid
                        @enderror"
                        id="register-password" name="password" placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary ">Daftar</button>
                </div>
                <div class="text-center">
                    <a href="#" class="text-decoration-none " onclick="toggleForms()">Sudah memiliki
                        akun?</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleForms() {
            document.getElementById('card-container').classList.toggle('flipped');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
