<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 50%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-logo {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.25rem;
        }
        .form-control:focus { border-color: #1e40af; box-shadow: 0 0 0 0.2rem rgba(30,64,175,0.15); }
        .btn-login {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none; color: #fff; padding: 0.75rem;
            border-radius: 8px; font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-login:hover { opacity: 0.9; color: #fff; }
        .demo-box { background: #f8fafc; border-radius: 8px; padding: 0.75rem; font-size: 0.8rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <i class="bi bi-mortarboard-fill text-white fs-4"></i>
        </div>
        <h4 class="text-center fw-bold mb-1">SIAKAD</h4>
        <p class="text-center text-muted mb-4" style="font-size:0.9rem">Sistem Informasi Akademik</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 mb-3">
                <i class="bi bi-exclamation-circle me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.85rem">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="email@domain.com" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.85rem">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:0.85rem">Ingat saya</label>
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="demo-box mt-4">
            <div class="fw-semibold mb-1 text-muted">Akun Demo:</div>
            <div><b>Admin:</b> admin@siakad.ac.id / password</div>
            <div><b>Mahasiswa:</b> aldi@mahasiswa.ac.id / password</div>
        </div>
    </div>
</body>
</html>
