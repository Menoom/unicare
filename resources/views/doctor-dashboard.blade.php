<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Dashboard — UniCare</title>
    <meta name="description" content="UniCare Staff Dashboard — manage appointments, patients, schedules, and practice analytics.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/doctor-dashboard-blade.css'])
</head>
<body>

    <!-- ==================
         SIDEBAR
         ================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-brand">
                <i class="fa-solid fa-stethoscope"></i> UniCare
                <span class="staff-tag">Staff</span>
            </a>
            <button class="sidebar-close" id="sidebarClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-label">Overview</span>
            <a href="/doctor-dashboard" class="nav-link active">
                <i class="fa-solid fa-grid-2"></i> Dashboard
            </a>

            <span class="nav-label">Practice</span>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-calendar-check"></i> Appointments
                <span class="nav-badge">12</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-users"></i> Patients
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-clock"></i> Schedule
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-file-medical"></i> Medical Records
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-capsules"></i> Prescriptions
            </a>

            <span class="nav-label">Analytics</span>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-chart-line"></i> Reports
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-chart-pie"></i> Revenue
            </a>

            <span class="nav-label">Account</span>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-bell"></i> Notifications
                <span class="nav-badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-avatar-sm">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            <div class="user-meta">
                <span class="name">{{ Auth::user()->name ?? 'Dr. Staff' }}</span>
                <span class="role"><i class="fa-solid fa-circle"></i> Doctor</span>
            </div>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================
         MAIN
         ================== -->
    <div class="main" id="mainContent">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburger">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1>Staff Dashboard</h1>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" title="Messages">
                    <i class="fa-regular fa-envelope"></i>
                </button>
                <button class="topbar-btn" title="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span class="notif-dot"></span>
                </button>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="content">
            <!-- Welcome banner -->
            <div class="welcome-banner">
                <h2>Welcome back, {{ Auth::user()->name ?? 'Doctor' }} 👩‍⚕️</h2>
                <p>Here's your practice overview for today. You have <strong>12 appointments</strong> scheduled.</p>
                <div class="welcome-date">
                    <i class="fa-regular fa-calendar"></i>
                    <span id="todayDate"></span>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-calendar-day"></i></div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Today's Appointments</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 15% from yesterday</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-value">847</div>
                    <div class="stat-label">Total Patients</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 23 new this month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-indian-rupee-sign"></i></div>
                    <div class="stat-value">₹1.2L</div>
                    <div class="stat-label">Monthly Revenue</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 8% from last month</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-star"></i></div>
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Average Rating</div>
                    <div class="stat-change up"><i class="fa-solid fa-arrow-up"></i> 127 reviews</div>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="quick-actions">
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-1"><i class="fa-solid fa-plus"></i></div>
                    <span>New Appointment</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-2"><i class="fa-solid fa-user-plus"></i></div>
                    <span>Add Patient</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-3"><i class="fa-solid fa-file-prescription"></i></div>
                    <span>Write Prescription</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-4"><i class="fa-solid fa-chart-bar"></i></div>
                    <span>View Reports</span>
                </a>
            </div>

            <!-- Two column layout: Appointments table + Schedule -->
            <div class="grid-2">
                <!-- Today's Appointments -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-calendar-check"></i> Today's Appointments</h3>
                        <a href="#" class="btn-sm"><i class="fa-solid fa-eye"></i> View All</a>
                    </div>
                    <table class="appt-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Aarav Gupta</div>
                                            <div class="id">#PT-001</div>
                                        </div>
                                    </div>
                                </td>
                                <td>9:00 AM</td>
                                <td>Checkup</td>
                                <td><span class="badge-sm badge-completed">Completed</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Meera Iyer</div>
                                            <div class="id">#PT-042</div>
                                        </div>
                                    </div>
                                </td>
                                <td>10:00 AM</td>
                                <td>Follow-up</td>
                                <td><span class="badge-sm badge-confirmed">Confirmed</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Raj Malhotra</div>
                                            <div class="id">#PT-118</div>
                                        </div>
                                    </div>
                                </td>
                                <td>11:30 AM</td>
                                <td>Consultation</td>
                                <td><span class="badge-sm badge-confirmed">Confirmed</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Neha Sharma</div>
                                            <div class="id">#PT-205</div>
                                        </div>
                                    </div>
                                </td>
                                <td>1:00 PM</td>
                                <td>Lab Review</td>
                                <td><span class="badge-sm badge-pending">Pending</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Vikram Joshi</div>
                                            <div class="id">#PT-310</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2:30 PM</td>
                                <td>Checkup</td>
                                <td><span class="badge-sm badge-confirmed">Confirmed</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="patient-cell">
                                        <div class="patient-avatar"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <div class="name">Priya Acharya</div>
                                            <div class="id">#PT-088</div>
                                        </div>
                                    </div>
                                </td>
                                <td>4:00 PM</td>
                                <td>Follow-up</td>
                                <td><span class="badge-sm badge-cancelled">Cancelled</span></td>
                                <td><button class="action-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Schedule & Performance -->
                <div style="display: flex; flex-direction: column; gap: 22px;">
                    <!-- Today's Schedule -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-clock"></i> Today's Schedule</h3>
                        </div>
                        <div class="schedule-list">
                            <div class="schedule-item">
                                <span class="schedule-time">9:00</span>
                                <div class="schedule-bar bar-green"></div>
                                <div class="schedule-detail">
                                    <div class="title">Checkup — Aarav G.</div>
                                    <div class="sub">Completed</div>
                                </div>
                            </div>
                            <div class="schedule-item">
                                <span class="schedule-time">10:00</span>
                                <div class="schedule-bar bar-purple"></div>
                                <div class="schedule-detail">
                                    <div class="title">Follow-up — Meera I.</div>
                                    <div class="sub">In Progress</div>
                                </div>
                            </div>
                            <div class="schedule-item">
                                <span class="schedule-time">11:30</span>
                                <div class="schedule-bar bar-teal"></div>
                                <div class="schedule-detail">
                                    <div class="title">Consultation — Raj M.</div>
                                    <div class="sub">Upcoming</div>
                                </div>
                            </div>
                            <div class="schedule-item">
                                <span class="schedule-time">1:00</span>
                                <div class="schedule-bar bar-amber"></div>
                                <div class="schedule-detail">
                                    <div class="title">Lab Review — Neha S.</div>
                                    <div class="sub">Pending Confirmation</div>
                                </div>
                            </div>
                            <div class="schedule-item">
                                <span class="schedule-time">2:30</span>
                                <div class="schedule-bar bar-teal"></div>
                                <div class="schedule-detail">
                                    <div class="title">Checkup — Vikram J.</div>
                                    <div class="sub">Upcoming</div>
                                </div>
                            </div>
                            <div class="schedule-item">
                                <span class="schedule-time">4:00</span>
                                <div class="schedule-bar bar-empty"></div>
                                <div class="schedule-detail">
                                    <div class="title" style="text-decoration: line-through; opacity:.5;">Follow-up — Priya A.</div>
                                    <div class="sub" style="color: var(--danger);">Cancelled</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fa-solid fa-chart-line"></i> This Month</h3>
                        </div>
                        <div class="perf-grid">
                            <div class="perf-item">
                                <div class="value">186</div>
                                <div class="label">Consultations</div>
                            </div>
                            <div class="perf-item">
                                <div class="value">94%</div>
                                <div class="label">Satisfaction</div>
                            </div>
                            <div class="perf-item">
                                <div class="value">18 min</div>
                                <div class="label">Avg. Duration</div>
                            </div>
                            <div class="perf-item">
                                <div class="value">3.2%</div>
                                <div class="label">No-show Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Patients -->
            <div class="card" style="margin-bottom: 28px;">
                <div class="card-header">
                    <h3><i class="fa-solid fa-users"></i> Recent Patients</h3>
                    <a href="#" class="btn-sm"><i class="fa-solid fa-list"></i> All Patients</a>
                </div>
                <div class="patient-list">
                    <div class="patient-row">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="info">
                            <div class="name">Aarav Gupta</div>
                            <div class="detail">Male · 34 yrs · Hypertension follow-up</div>
                        </div>
                        <div class="date">Today</div>
                    </div>
                    <div class="patient-row">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="info">
                            <div class="name">Meera Iyer</div>
                            <div class="detail">Female · 28 yrs · Post-surgery checkup</div>
                        </div>
                        <div class="date">Today</div>
                    </div>
                    <div class="patient-row">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="info">
                            <div class="name">Raj Malhotra</div>
                            <div class="detail">Male · 45 yrs · Chest pain evaluation</div>
                        </div>
                        <div class="date">Today</div>
                    </div>
                    <div class="patient-row">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="info">
                            <div class="name">Diya Kapoor</div>
                            <div class="detail">Female · 22 yrs · Routine blood work</div>
                        </div>
                        <div class="date">Yesterday</div>
                    </div>
                    <div class="patient-row">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="info">
                            <div class="name">Ankit Saxena</div>
                            <div class="detail">Male · 51 yrs · Diabetes management</div>
                        </div>
                        <div class="date">Feb 15</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        (function(){
            // Today's date
            var d = new Date();
            var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            var el = document.getElementById('todayDate');
            if(el) el.textContent = days[d.getDay()] + ', ' + months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();

            // Sidebar toggle
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebarOverlay');
            var hamburger = document.getElementById('hamburger');
            var closeBtn = document.getElementById('sidebarClose');

            function openSidebar() { sidebar.classList.add('open'); overlay.classList.add('visible'); }
            function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('visible'); }

            if(hamburger) hamburger.addEventListener('click', openSidebar);
            if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if(overlay) overlay.addEventListener('click', closeSidebar);
        })();
    </script>

</body>
</html>
