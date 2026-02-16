<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard — UniCare</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	@vite(['resources/css/app.css'])
</head>
<body class="dash-body">

	<!-- Sidebar -->
	<aside class="dash-sidebar" id="sidebar">
		<div class="sidebar-header">
			<a href="/" class="sidebar-brand">
				<i class="fa-solid fa-stethoscope"></i> UniCare
			</a>
			<button class="sidebar-close" id="sidebarClose">
				<i class="fa-solid fa-xmark"></i>
			</button>
		</div>

		<nav class="sidebar-nav">
			<span class="sidebar-label">Menu</span>
			<a href="/dashboard" class="sidebar-link active">
				<i class="fa-solid fa-grid-2"></i> Dashboard
			</a>
			<a href="/#home" class="sidebar-link">
				<i class="fa-solid fa-house"></i> Home
			</a>

			<span class="sidebar-label">Account</span>
			<a href="#" class="sidebar-link">
				<i class="fa-solid fa-bell"></i> Notifications
				<span class="sidebar-badge">3</span>
			</a>
			<a href="#" class="sidebar-link">
				<i class="fa-solid fa-clock"></i> Reminders
				<span class="sidebar-badge">2</span>
			</a>
			<a href="#" class="sidebar-link">
				<i class="fa-solid fa-calendar-check"></i> My Appointments
			</a>
			<a href="#" class="sidebar-link">
				<i class="fa-solid fa-file-medical"></i> Medical Records
			</a>
			<a href="#" class="sidebar-link">
				<i class="fa-solid fa-gear"></i> Settings
			</a>
		</nav>

		<!-- User card at bottom of sidebar -->
		<div class="sidebar-user">
			<div class="user-avatar">
				<i class="fa-solid fa-user"></i>
			</div>
			<div class="user-info">
				<span class="user-name">Hello, {{ Auth::user()->name ?? 'Guest' }}</span>
				<span class="user-id">ID: #{{ strtoupper(substr(md5(rand()), 0, 6)) }}</span>
				<span class="user-role"><i class="fa-solid fa-circle" style="font-size: 6px; color: #22c55e; vertical-align: middle;"></i> Patient</span>
			</div>
		</div>
	</aside>

	<!-- Overlay for mobile -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- Main wrapper -->
	<div class="dash-main" id="dashMain">
		<!-- Top bar -->
		<header class="dash-topbar">
			<div class="topbar-left">
				<h1 class="topbar-title">Dashboard</h1>
			</div>
			<div class="topbar-right">
				<button id="dashThemeToggle" class="dash-toggle-btn" title="Toggle dark mode">
					<i class="fa-regular fa-moon"></i>
				</button>
				<form action="{{ route('logout') }}" method="POST" class="d-inline">
					@csrf
					<button type="submit" class="dash-logout-btn">
						<i class="fa-solid fa-right-from-bracket"></i> Logout
					</button>
				</form>
			</div>
		</header>

		<div class="dash-content">
			<!-- Section header -->
			<div class="dash-section-header">
				<h2 class="dash-section-title">Book a Doctor</h2>
				<p class="text-muted">Browse our specialists and book an appointment.</p>
			</div>

			<!-- Filter bar -->
			<div class="filter-bar">
				<div class="filter-bar-header">
					<i class="fa-solid fa-filter"></i>
					<span>Filters</span>
					<button class="filter-reset-btn" id="filterReset">Reset All</button>
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
						<label for="filterPractice">Practice Type</label>
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

			<!-- Active filter count -->
			<div class="filter-status" id="filterStatus"></div>

			<div class="row" id="doctorGrid">
				<!-- Doctor 1 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="cardiologist" data-practice="hospital" data-fee="800" data-availability="available" data-gender="female">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Sarah Mitchell</h5>
						<span class="doctor-specialty">Cardiologist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 800</p>
						<a href="/doctor/1" class="btn-book-doc">Book Appointment</a>
					</div>
				</div>

				<!-- Doctor 2 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="dermatologist" data-practice="private" data-fee="600" data-availability="available" data-gender="male">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. James Patel</h5>
						<span class="doctor-specialty">Dermatologist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 600</p>
						<a href="/doctor/2" class="btn-book-doc">Book Appointment</a>
					</div>
				</div>

				<!-- Doctor 3 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="pediatrician" data-practice="hospital" data-fee="700" data-availability="fully-booked" data-gender="female">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Priya Sharma</h5>
						<span class="doctor-specialty">Pediatrician</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-fully-booked"></span>
							<span class="status-text">Fully Booked</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 700</p>
						<a href="/doctor/3" class="btn-book-doc btn-book-disabled">Fully Booked</a>
					</div>
				</div>

				<!-- Doctor 4 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="orthopedic" data-practice="hospital" data-fee="1000" data-availability="available" data-gender="male">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Arjun Reddy</h5>
						<span class="doctor-specialty">Orthopedic Surgeon</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 1000</p>
						<a href="/doctor/4" class="btn-book-doc">Book Appointment</a>
					</div>
				</div>

				<!-- Doctor 5 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="neurologist" data-practice="hospital" data-fee="1200" data-availability="unavailable" data-gender="female">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Emily Chen</h5>
						<span class="doctor-specialty">Neurologist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-unavailable"></span>
							<span class="status-text">Unavailable</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 1200</p>
						<a href="/doctor/5" class="btn-book-doc btn-book-disabled">Unavailable</a>
					</div>
				</div>

				<!-- Doctor 6 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="gynecologist" data-practice="private" data-fee="900" data-availability="available" data-gender="female">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Kavita Nair</h5>
						<span class="doctor-specialty">Gynecologist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 900</p>
						<a href="/doctor/6" class="btn-book-doc">Book Appointment</a>
					</div>
				</div>

				<!-- Doctor 7 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="general" data-practice="private" data-fee="400" data-availability="available" data-gender="male">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Rahul Verma</h5>
						<span class="doctor-specialty">General Physician</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 400</p>
						<a href="/doctor/7" class="btn-book-doc">Book Appointment</a>
					</div>
				</div>

				<!-- Doctor 8 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="ent" data-practice="hospital" data-fee="650" data-availability="fully-booked" data-gender="male">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Vikram Sinha</h5>
						<span class="doctor-specialty">ENT Specialist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-hospital"><i class="fa-solid fa-hospital"></i> Hospital</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-fully-booked"></span>
							<span class="status-text">Fully Booked</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 650</p>
						<a href="/doctor/8" class="btn-book-doc btn-book-disabled">Fully Booked</a>
					</div>
				</div>

				<!-- Doctor 9 -->
				<div class="col-lg-4 col-md-6 mb-4 doctor-col" data-specialty="ophthalmologist" data-practice="private" data-fee="1100" data-availability="unavailable" data-gender="female">
					<div class="doctor-card">
						<div class="doctor-avatar">
							<i class="fa-solid fa-user-doctor"></i>
						</div>
						<h5 class="doctor-name">Dr. Ananya Das</h5>
						<span class="doctor-specialty">Ophthalmologist</span>
						<div class="doctor-tags">
							<span class="tag-badge tag-private"><i class="fa-solid fa-clinic-medical"></i> Private</span>
						</div>
						<div class="availability-status">
							<span class="status-dot dot-unavailable"></span>
							<span class="status-text">Unavailable</span>
						</div>
						<p class="doctor-fee">Consultation Fee: <i class="fa-solid fa-indian-rupee-sign"></i> 1100</p>
						<a href="/doctor/9" class="btn-book-doc btn-book-disabled">Unavailable</a>
					</div>
				</div>
			</div>

			<!-- No results message -->
			<div class="no-results" id="noResults" style="display:none;">
				<i class="fa-solid fa-search"></i>
				<p>No doctors match your filters. Try adjusting your criteria.</p>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		(function () {
			// Theme
			var theme = localStorage.getItem('theme') || 'light';
			document.documentElement.setAttribute('data-theme', theme);
			var btn = document.getElementById('dashThemeToggle');
			if (btn) {
				if (theme === 'dark') btn.innerHTML = '<i class="fa-regular fa-sun"></i>';
				btn.addEventListener('click', function () {
					var current = document.documentElement.getAttribute('data-theme');
					var next = current === 'dark' ? 'light' : 'dark';
					document.documentElement.setAttribute('data-theme', next);
					localStorage.setItem('theme', next);
					this.innerHTML = next === 'dark' ? '<i class="fa-regular fa-sun"></i>' : '<i class="fa-regular fa-moon"></i>';
				});
			}

			// Sidebar (mobile only)
			var sidebar = document.getElementById('sidebar');
			var overlay = document.getElementById('sidebarOverlay');
			var closeBtn = document.getElementById('sidebarClose');

			function closeSidebar() {
				sidebar.classList.remove('open');
				overlay.classList.remove('visible');
			}
			if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
			if (overlay) overlay.addEventListener('click', closeSidebar);

			// Filters
			var selects = document.querySelectorAll('.filter-select');
			var cards = document.querySelectorAll('.doctor-col');
			var noResults = document.getElementById('noResults');
			var statusEl = document.getElementById('filterStatus');
			var resetBtn = document.getElementById('filterReset');

			function applyFilters() {
				var specialty = document.getElementById('filterSpecialty').value;
				var practice = document.getElementById('filterPractice').value;
				var availability = document.getElementById('filterAvailability').value;
				var gender = document.getElementById('filterGender').value;
				var fee = document.getElementById('filterFee').value;
				var visible = 0;
				var activeCount = 0;

				if (specialty) activeCount++;
				if (practice) activeCount++;
				if (availability) activeCount++;
				if (gender) activeCount++;
				if (fee) activeCount++;

				cards.forEach(function (card) {
					var show = true;
					var f = parseInt(card.dataset.fee);

					if (specialty && card.dataset.specialty !== specialty) show = false;
					if (practice && card.dataset.practice !== practice) show = false;
					if (availability && card.dataset.availability !== availability) show = false;
					if (gender && card.dataset.gender !== gender) show = false;

					if (fee) {
						if (fee === '0-500' && f > 500) show = false;
						if (fee === '500-1000' && (f < 500 || f > 1000)) show = false;
						if (fee === '1000+' && f < 1000) show = false;
					}

					card.style.display = show ? '' : 'none';
					if (show) visible++;
				});

				noResults.style.display = visible === 0 ? 'flex' : 'none';

				if (activeCount > 0) {
					statusEl.innerHTML = '<i class="fa-solid fa-filter"></i> ' + activeCount + ' filter' + (activeCount > 1 ? 's' : '') + ' active &middot; ' + visible + ' doctor' + (visible !== 1 ? 's' : '') + ' found';
					statusEl.style.display = 'block';
				} else {
					statusEl.style.display = 'none';
				}
			}

			selects.forEach(function (sel) {
				sel.addEventListener('change', applyFilters);
			});

			resetBtn.addEventListener('click', function () {
				selects.forEach(function (sel) { sel.value = ''; });
				applyFilters();
			});
		})();
	</script>
</body>
</html>
