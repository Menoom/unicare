<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - UniCare</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d6efd;
            --bg: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --surface: #f8fafc;
            --border: #e5e7eb;
            --shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        [data-theme="dark"] {
            --primary: #5aa0ff;
            --bg: #0f172a;
            --text: #e5e7eb;
            --muted: #94a3b8;
            --surface: #111827;
            --border: #1f2937;
            --shadow: 0 10px 25px rgba(0,0,0,0.35);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, rgba(13,110,253,.08), rgba(99,102,241,.08));
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: var(--bg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            border-radius: 18px;
            max-width: 440px;
            width: 100%;
        }
        .brand { color: var(--primary) !important; font-weight: 700; }
        .btn-primary { border-radius: 999px; }
        .form-control { border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="auth-card p-4 p-md-5 mx-auto">
            <div class="text-center mb-4">
                <a href="/" class="brand h4 text-decoration-none">
                    <i class="fa-solid fa-stethoscope mr-2"></i> UniCare
                </a>
                <h2 class="mt-3 mb-2">Welcome back</h2>
                <p class="text-muted">Login to book your appointment</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary font-weight-bold">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
