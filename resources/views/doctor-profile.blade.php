<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $doctor['name'] }} — UniCare</title>
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
			<a href="/dashboard" class="sidebar-link">
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
				<h1 class="topbar-title">Doctor Profile</h1>
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
			<!-- Back button -->
			<a href="/dashboard" class="profile-back-btn">
				<i class="fa-solid fa-arrow-left"></i> Back to Doctors
			</a>

			<!-- Success message -->
			@if(session('success'))
				<div class="booking-success" id="bookingSuccess">
					<i class="fa-solid fa-circle-check"></i>
					<span>{{ session('success') }}</span>
					<button class="success-close" onclick="document.getElementById('bookingSuccess').style.display='none'">
						<i class="fa-solid fa-xmark"></i>
					</button>
				</div>
			@endif

			<!-- Doctor profile card -->
			<div class="profile-wrapper">
				<!-- Left: Doctor info -->
				<div class="profile-info-card">
					<div class="profile-avatar">
						<i class="fa-solid fa-user-doctor"></i>
					</div>
					<h2 class="profile-name">{{ $doctor['name'] }}</h2>
					<span class="profile-specialty">{{ $doctor['specialty'] }}</span>

					<div class="profile-status">
						@if($doctor['availability'] === 'available')
							<span class="status-dot dot-available"></span>
							<span class="status-text">Available</span>
						@elseif($doctor['availability'] === 'fully-booked')
							<span class="status-dot dot-fully-booked"></span>
							<span class="status-text">Fully Booked</span>
						@else
							<span class="status-dot dot-unavailable"></span>
							<span class="status-text">Unavailable</span>
						@endif
					</div>

					<div class="profile-details">
						<div class="profile-detail-item">
							<i class="fa-solid fa-briefcase-medical"></i>
							<span>{{ $doctor['experience'] }} years experience</span>
						</div>
						<div class="profile-detail-item">
							<i class="fa-solid fa-{{ $doctor['practice_key'] === 'hospital' ? 'hospital' : 'clinic-medical' }}"></i>
							<span>{{ $doctor['practice'] }}</span>
						</div>
						<div class="profile-detail-item">
							<i class="fa-solid fa-{{ $doctor['gender'] === 'Female' ? 'venus' : 'mars' }}"></i>
							<span>{{ $doctor['gender'] }}</span>
						</div>
						<div class="profile-detail-item">
							<i class="fa-solid fa-graduation-cap"></i>
							<span>{{ $doctor['education'] }}</span>
						</div>
						<div class="profile-detail-item">
							<i class="fa-solid fa-language"></i>
							<span>{{ implode(', ', $doctor['languages']) }}</span>
						</div>
						<div class="profile-detail-item">
							<i class="fa-solid fa-indian-rupee-sign"></i>
							<span>Consultation Fee: ₹ {{ $doctor['fee'] }}</span>
						</div>
					</div>

					<div class="profile-about">
						<h5>About</h5>
						<p>{{ $doctor['about'] }}</p>
					</div>
				</div>

				<!-- Right: Time slots & booking -->
				<div class="profile-slots-card">
					<h4 class="slots-title"><i class="fa-regular fa-calendar"></i> Available Time Slots</h4>
					<p class="slots-date"><i class="fa-solid fa-calendar-day"></i> Today — {{ now()->format('d M Y, l') }}</p>

					@if(count($doctor['slots']) === 0)
						<div class="slots-empty">
							<i class="fa-solid fa-calendar-xmark"></i>
							<p>No time slots available for this doctor.</p>
						</div>
					@else
						<div class="slots-grid">
							@foreach($doctor['slots'] as $index => $slot)
								<div class="slot-item {{ $slot['booked'] ? 'slot-booked' : 'slot-open' }}">
									<span class="slot-time">{{ $slot['time'] }}</span>
									@if($slot['booked'])
										<span class="slot-label">Booked</span>
									@else
										<form action="{{ route('doctor.book', $doctor['id']) }}" method="POST" class="slot-book-form">
											@csrf
											<input type="hidden" name="slot" value="{{ $slot['time'] }}">
											<button type="submit" class="slot-book-btn">Book</button>
										</form>
									@endif
								</div>
							@endforeach
						</div>

						<div class="slots-legend">
							<span class="legend-item"><span class="legend-dot legend-open"></span> Available</span>
							<span class="legend-item"><span class="legend-dot legend-booked"></span> Booked</span>
						</div>
					@endif
				</div>
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
		})();
	</script>
</body>
</html>
