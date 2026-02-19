<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - UniCare</title>
    <meta name="description" content="UniCare Admin Dashboard - manage users, doctors, and platform operations.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin-dashboard-blade.css'])
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="brand">
                <i class="fa-solid fa-stethoscope"></i>
                <span>UniCare Admin</span>
            </a>
            <button class="sidebar-close" id="sidebarClose" aria-label="Close sidebar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-label">Overview</span>
            <a href="#" class="nav-link active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="#" class="nav-link"><i class="fa-solid fa-user-doctor"></i> Doctors</a>
            <a href="#" class="nav-link"><i class="fa-solid fa-users"></i> Patients</a>
            <a href="#" class="nav-link"><i class="fa-solid fa-calendar-check"></i> Appointments</a>
            <a href="#" class="nav-link"><i class="fa-solid fa-shield-halved"></i> Roles & Access</a>
        </nav>
    </aside>

    <div class="overlay" id="overlay"></div>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburger" aria-label="Open sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1>Admin Dashboard</h1>
            </div>
            <div class="topbar-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <section class="content">
            <div class="hero">
                <h2>Platform Overview</h2>
                <p>Track critical admin metrics and manage operational actions from one place.</p>
            </div>

            <div class="stats-grid">
                <article class="card stat-card">
                    <div class="stat-icon icon-blue"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="stat-value">128</div>
                    <div class="stat-label">Active Doctors</div>
                </article>
                <article class="card stat-card">
                    <div class="stat-icon icon-green"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-value">9,420</div>
                    <div class="stat-label">Registered Patients</div>
                </article>
                <article class="card stat-card">
                    <div class="stat-icon icon-amber"><i class="fa-solid fa-calendar-day"></i></div>
                    <div class="stat-value">312</div>
                    <div class="stat-label">Today's Appointments</div>
                </article>
                <article class="card stat-card">
                    <div class="stat-icon icon-red"><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class="stat-value">7</div>
                    <div class="stat-label">Pending Verifications</div>
                </article>
            </div>

            <div class="grid-2">
                <article class="card">
                    <div class="card-head">
                        <h3>Recent Admin Actions</h3>
                    </div>
                    <ul class="list">
                        <li><span>Approved Dr. Ananya Das profile</span><time>10m ago</time></li>
                        <li><span>Updated role permissions for support team</span><time>34m ago</time></li>
                        <li><span>Flagged duplicate patient account</span><time>1h ago</time></li>
                        <li><span>Published weekly appointment report</span><time>2h ago</time></li>
                    </ul>
                </article>

                <article class="card">
                    <div class="card-head">
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="actions">
                        <a href="#" class="action-btn"><i class="fa-solid fa-user-plus"></i> Add Doctor</a>
                        <a href="#" class="action-btn"><i class="fa-solid fa-user-shield"></i> Manage Roles</a>
                        <a href="#" class="action-btn"><i class="fa-solid fa-file-export"></i> Export Reports</a>
                        <a href="#" class="action-btn"><i class="fa-solid fa-gear"></i> System Settings</a>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <script>
        (function () {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');
            var hamburger = document.getElementById('hamburger');
            var closeBtn = document.getElementById('sidebarClose');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('visible');
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('visible');
            }

            if (hamburger) hamburger.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        })();
    </script>
</body>
</html>
