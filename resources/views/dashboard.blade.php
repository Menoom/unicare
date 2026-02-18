<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Dashboard — UniCare</title>
    <meta name="description" content="UniCare Patient Dashboard — book appointments, view your health records, and manage your medical journey.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/dashboard-blade.css'])
</head>
<body>

    <!-- ==================
         SIDEBAR
         ================== -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-brand">
                <i class="fa-solid fa-stethoscope"></i> UniCare
            </a>
            <button class="sidebar-close" id="sidebarClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-label">Menu</span>
            <a href="/dashboard" class="nav-link active">
                <i class="fa-solid fa-grid-2"></i> Dashboard
            </a>
            <a href="/" class="nav-link">
                <i class="fa-solid fa-house"></i> Home
            </a>

            <span class="nav-label">Health</span>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-calendar-check"></i> My Appointments
                <span class="nav-badge">2</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-file-medical"></i> Medical Records
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-capsules"></i> Prescriptions
            </a>

            <span class="nav-label">Account</span>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-bell"></i> Notifications
                <span class="nav-badge">3</span>
            </a>
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-avatar-sm">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-meta">
                <span class="name">{{ Auth::user()->name ?? 'Guest' }}</span>
                <span class="role"><i class="fa-solid fa-circle"></i> Patient</span>
            </div>
        </div>
    </aside>

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ==================
         MAIN
         ================== -->
    <div class="main" id="mainContent">
        <!-- Top bar -->
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburger">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1>Dashboard</h1>
            </div>
            <div class="topbar-right">
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
                <h2>Good afternoon, {{ Auth::user()->name ?? 'Guest' }} 👋</h2>
                <p>Browse our specialists below and book your next appointment.</p>
                <div class="welcome-date">
                    <i class="fa-regular fa-calendar"></i>
                    <span id="todayDate"></span>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="quick-actions">
                <a href="#doctorSection" class="quick-action">
                    <div class="quick-action-icon qa-1"><i class="fa-solid fa-user-doctor"></i></div>
                    <span>Book Doctor</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-2"><i class="fa-solid fa-video"></i></div>
                    <span>Video Consult</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-3"><i class="fa-solid fa-flask"></i></div>
                    <span>Lab Results</span>
                </a>
                <a href="#" class="quick-action">
                    <div class="quick-action-icon qa-4"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <span>Visit History</span>
                </a>
            </div>

            <!-- Upcoming appointments -->
            <div class="appts-section">
                <div class="section-header">
                    <div>
                        <h2>Upcoming Appointments</h2>
                        <p class="subtitle">Your next scheduled visits</p>
                    </div>
                </div>
                <div class="appt-list">
                    <div class="appt-item">
                        <div class="appt-date-box">
                            <span class="day">22</span>
                            <span class="month">Feb</span>
                        </div>
                        <div class="appt-info">
                            <div class="appt-doctor">Dr. Sarah Mitchell</div>
                            <div class="appt-detail">
                                <i class="fa-solid fa-heart-pulse"></i> Cardiologist · City Hospital
                            </div>
                        </div>
                        <div class="appt-time">
                            <div class="time">10:00 AM</div>
                            <div class="duration">30 min</div>
                        </div>
                        <div class="appt-status status-confirmed">Confirmed</div>
                    </div>
                    <div class="appt-item">
                        <div class="appt-date-box">
                            <span class="day">28</span>
                            <span class="month">Feb</span>
                        </div>
                        <div class="appt-info">
                            <div class="appt-doctor">Dr. Rahul Verma</div>
                            <div class="appt-detail">
                                <i class="fa-solid fa-stethoscope"></i> General Physician · MediCare Clinic
                            </div>
                        </div>
                        <div class="appt-time">
                            <div class="time">2:30 PM</div>
                            <div class="duration">20 min</div>
                        </div>
                        <div class="appt-status status-pending">Pending</div>
                    </div>
                </div>
            </div>

            <!-- Book a Doctor -->
            <div id="doctorSection">
                <div class="section-header">
                    <div>
                        <h2>Book a Doctor</h2>
                        <p class="subtitle">Browse our specialists and book an appointment</p>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-bar">
                    <div class="filter-bar-head">
                        <span><i class="fa-solid fa-sliders"></i> Filters</span>
                        <button class="btn-reset" id="filterReset">Reset All</button>
                    </div>
                    <div class="filter-controls">
                        <div class="filter-group">
                            <label for="filterSpecialty">Specialty</label>
                            <select id="filterSpecialty" class="filter-select">
                                <option value="">All Specialties</option>
                                <option value="cardiologist">Cardiologist</option>
                                <option value="dermatologist">Dermatologist</option>
                                <option value="pediatrician">Pediatrician</option>
                                <option value="orthopedic">Orthopedic Surgeon</option>
                                <option value="neurologist">Neurologist</option>
                                <option value="gynecologist">Gynecologist</option>
                                <option value="general">General Physician</option>
                                <option value="ent">ENT Specialist</option>
                                <option value="ophthalmologist">Ophthalmologist</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filterPractice">Practice</label>
                            <select id="filterPractice" class="filter-select">
                                <option value="">All</option>
                                <option value="private">Private Clinic</option>
                                <option value="hospital">Hospital</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filterAvailability">Availability</label>
                            <select id="filterAvailability" class="filter-select">
                                <option value="">All</option>
                                <option value="available">Available</option>
                                <option value="fully-booked">Fully Booked</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filterGender">Gender</label>
                            <select id="filterGender" class="filter-select">
                                <option value="">All</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filterFee">Fee Range</label>
                            <select id="filterFee" class="filter-select">
                                <option value="">All</option>
                                <option value="0-500">Under ₹500</option>
                                <option value="500-1000">₹500 – ₹1000</option>
                                <option value="1000+">Above ₹1000</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="filter-status" id="filterStatus"></div>

                <!-- Doctor cards -->
                <div class="doctor-grid" id="doctorGrid">
                    <!-- Doctor 1 -->
                    <div class="doc-card" data-specialty="cardiologist" data-practice="hospital" data-fee="800" data-availability="available" data-gender="female">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Sarah Mitchell</span>
                                <span class="doc-spec">Cardiologist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-available"></span>
                            <span>Available</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹800</strong></div>
                        <a href="/doctor/1" class="btn-book btn-book-active">Book Appointment</a>
                    </div>

                    <!-- Doctor 2 -->
                    <div class="doc-card" data-specialty="dermatologist" data-practice="private" data-fee="600" data-availability="available" data-gender="male">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. James Patel</span>
                                <span class="doc-spec">Dermatologist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-available"></span>
                            <span>Available</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹600</strong></div>
                        <a href="/doctor/2" class="btn-book btn-book-active">Book Appointment</a>
                    </div>

                    <!-- Doctor 3 -->
                    <div class="doc-card" data-specialty="pediatrician" data-practice="hospital" data-fee="700" data-availability="fully-booked" data-gender="female">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Priya Sharma</span>
                                <span class="doc-spec">Pediatrician</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-booked"></span>
                            <span>Fully Booked</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹700</strong></div>
                        <span class="btn-book btn-book-disabled">Fully Booked</span>
                    </div>

                    <!-- Doctor 4 -->
                    <div class="doc-card" data-specialty="orthopedic" data-practice="hospital" data-fee="1000" data-availability="available" data-gender="male">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Arjun Reddy</span>
                                <span class="doc-spec">Orthopedic Surgeon</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-available"></span>
                            <span>Available</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹1000</strong></div>
                        <a href="/doctor/4" class="btn-book btn-book-active">Book Appointment</a>
                    </div>

                    <!-- Doctor 5 -->
                    <div class="doc-card" data-specialty="neurologist" data-practice="hospital" data-fee="1200" data-availability="unavailable" data-gender="female">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Emily Chen</span>
                                <span class="doc-spec">Neurologist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-unavailable"></span>
                            <span>Unavailable</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹1200</strong></div>
                        <span class="btn-book btn-book-disabled">Unavailable</span>
                    </div>

                    <!-- Doctor 6 -->
                    <div class="doc-card" data-specialty="gynecologist" data-practice="private" data-fee="900" data-availability="available" data-gender="female">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Kavita Nair</span>
                                <span class="doc-spec">Gynecologist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-available"></span>
                            <span>Available</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹900</strong></div>
                        <a href="/doctor/6" class="btn-book btn-book-active">Book Appointment</a>
                    </div>

                    <!-- Doctor 7 -->
                    <div class="doc-card" data-specialty="general" data-practice="private" data-fee="400" data-availability="available" data-gender="male">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Rahul Verma</span>
                                <span class="doc-spec">General Physician</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-available"></span>
                            <span>Available</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹400</strong></div>
                        <a href="/doctor/7" class="btn-book btn-book-active">Book Appointment</a>
                    </div>

                    <!-- Doctor 8 -->
                    <div class="doc-card" data-specialty="ent" data-practice="hospital" data-fee="650" data-availability="fully-booked" data-gender="male">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Vikram Sinha</span>
                                <span class="doc-spec">ENT Specialist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-booked"></span>
                            <span>Fully Booked</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹650</strong></div>
                        <span class="btn-book btn-book-disabled">Fully Booked</span>
                    </div>

                    <!-- Doctor 9 -->
                    <div class="doc-card" data-specialty="ophthalmologist" data-practice="private" data-fee="1100" data-availability="unavailable" data-gender="female">
                        <div class="doc-card-top">
                            <div class="doc-avatar"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="doc-info">
                                <span class="doc-name">Dr. Ananya Das</span>
                                <span class="doc-spec">Ophthalmologist</span>
                            </div>
                        </div>
                        <div class="doc-tags">
                            <span class="doc-tag tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
                        </div>
                        <div class="doc-status">
                            <span class="status-dot dot-unavailable"></span>
                            <span>Unavailable</span>
                        </div>
                        <div class="doc-fee">Fee: <strong>₹1100</strong></div>
                        <span class="btn-book btn-book-disabled">Unavailable</span>
                    </div>
                </div>

                <div class="no-results" id="noResults">
                    <i class="fa-solid fa-search"></i>
                    <p>No doctors match your filters. Try adjusting your criteria.</p>
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

            // Filters
            var selects = document.querySelectorAll('.filter-select');
            var cards = document.querySelectorAll('.doc-card');
            var noResults = document.getElementById('noResults');
            var statusEl = document.getElementById('filterStatus');
            var resetBtn = document.getElementById('filterReset');

            function applyFilters() {
                var specialty = document.getElementById('filterSpecialty').value;
                var practice  = document.getElementById('filterPractice').value;
                var availability = document.getElementById('filterAvailability').value;
                var gender = document.getElementById('filterGender').value;
                var fee = document.getElementById('filterFee').value;
                var visible = 0, activeCount = 0;

                if(specialty) activeCount++;
                if(practice) activeCount++;
                if(availability) activeCount++;
                if(gender) activeCount++;
                if(fee) activeCount++;

                cards.forEach(function(card){
                    var show = true;
                    var f = parseInt(card.dataset.fee);

                    if(specialty && card.dataset.specialty !== specialty) show = false;
                    if(practice && card.dataset.practice !== practice) show = false;
                    if(availability && card.dataset.availability !== availability) show = false;
                    if(gender && card.dataset.gender !== gender) show = false;

                    if(fee){
                        if(fee === '0-500' && f > 500) show = false;
                        if(fee === '500-1000' && (f < 500 || f > 1000)) show = false;
                        if(fee === '1000+' && f < 1000) show = false;
                    }

                    card.style.display = show ? '' : 'none';
                    if(show) visible++;
                });

                noResults.style.display = visible === 0 ? 'flex' : 'none';

                if(activeCount > 0){
                    statusEl.innerHTML = '<i class="fa-solid fa-filter"></i> ' + activeCount + ' filter' + (activeCount > 1 ? 's':'') + ' active &middot; ' + visible + ' doctor' + (visible !== 1 ? 's':'') + ' found';
                    statusEl.style.display = 'flex';
                } else {
                    statusEl.style.display = 'none';
                }
            }

            selects.forEach(function(sel){ sel.addEventListener('change', applyFilters); });
            resetBtn.addEventListener('click', function(){ selects.forEach(function(s){ s.value=''; }); applyFilters(); });
        })();
    </script>

</body>
</html>
