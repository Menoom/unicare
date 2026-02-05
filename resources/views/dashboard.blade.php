<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - UniCare</title>
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
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--surface);
            color: var(--text);
        }
        .navbar { box-shadow: var(--shadow); background: var(--bg) !important; }
        .brand { color: var(--primary) !important; font-weight: 700; }
        .card { border: 1px solid var(--border); box-shadow: var(--shadow); border-radius: 14px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand brand" href="/"><i class="fa-solid fa-stethoscope mr-2"></i> UniCare</a>
            <div class="ml-auto">
                <span class="mr-3">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                <div class="card p-4">
                    <h5 class="mb-3">Dashboard</h5>
                    <p class="text-muted">You're now logged in. Appointment booking functionality will be added next.</p>
                    <div class="alert alert-info">
                        <i class="fa-solid fa-info-circle mr-2"></i>
                        This is a placeholder dashboard. Appointment features coming soon!
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
