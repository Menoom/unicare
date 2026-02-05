<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UniCare — Appointments & Consultations</title>

	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<!-- Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<!-- Font -->
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
		html, body { height: 100%; }
		body {
			font-family: 'Poppins', sans-serif;
			background: var(--bg);
			color: var(--text);
			line-height: 1.6;
		}
	/* Navbar */
	.navbar { box-shadow: var(--shadow); background: var(--bg) !important; }
	.navbar .nav-link { color: var(--text) !important; font-weight: 500; }
	.navbar .nav-link:hover { color: var(--primary) !important; }
	.brand { color: var(--primary) !important; font-weight: 700; letter-spacing: .2px; }
	.navbar-center { justify-content: center !important; }
		/* Dark toggle */
		.toggle-btn { border: 1px solid var(--border); color: var(--text); }
		.toggle-btn:hover { background: var(--surface); }
		/* Hero */
		.hero {
			background: linear-gradient(135deg, rgba(13,110,253,.08), rgba(99,102,241,.08));
			border-bottom: 1px solid var(--border);
		}
		.hero-card {
			background: var(--bg);
			border: 1px solid var(--border);
			box-shadow: var(--shadow);
			border-radius: 18px;
			max-width: 980px;
			margin: 0 auto;
		}
		.hero-wrap { padding-left: 12px; padding-right: 12px; }
		@media (min-width: 992px) { .hero-wrap { padding-left: 24px; padding-right: 24px; } }
		.hero-title { font-size: 2.25rem; }
		.hero-sub { font-size: 1rem; }
		.btn-scale { padding: .55rem 1rem; font-size: .95rem; }
		.pill { border-radius: 999px; }
		/* Sections */
		.section { padding: 60px 0; }
		.section-title { font-weight: 700; }
		.card-lite { background: var(--bg); border: 1px solid var(--border); box-shadow: var(--shadow); border-radius: 14px; }
		.footer { border-top: 1px solid var(--border); }
	</style>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light sticky-top">
		<div class="container">
			<a class="navbar-brand brand mx-auto" href="#">
				<i class="fa-solid fa-stethoscope mr-2"></i> UniCare
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse navbar-center" id="navbarNav">
				<ul class="navbar-nav align-items-lg-center">
					<li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
					<li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
					<li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
					<li class="nav-item ml-lg-3 mt-2 mt-lg-0">
						<a href="/login" class="btn btn-primary pill btn-scale">Book Appointment</a>
					</li>
					<li class="nav-item ml-2 mt-2 mt-lg-0">
						<button id="themeToggle" class="btn toggle-btn pill" title="Toggle dark mode">
							<i class="fa-regular fa-moon"></i>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Hero -->
	<section id="home" class="hero py-5">
		<div class="container-fluid hero-wrap">
			<div class="hero-card p-4 p-md-5">
				<div class="row align-items-center">
					<div class="col-lg-7 mb-4 mb-lg-0">
						<span class="badge badge-primary pill mb-2">Appointments & Consultations</span>
						<h1 class="hero-title mb-2">Your health, our priority</h1>
						<p class="hero-sub mb-3 text-muted">Book appointments, consult with doctors, and manage your records in one sleek experience.</p>
						<div class="d-flex flex-wrap">
							<a href="/login" class="btn btn-primary pill btn-scale mr-2 mb-2">Book Appointment</a>
							<a href="/register" class="btn btn-outline-primary pill btn-scale mb-2">Create Account</a>
						</div>
						<div class="mt-2 text-muted small">Booking requires login. New here? Sign up first.</div>
					</div>
					<div class="col-lg-5">
						<!-- Inline illustration SVG (no heavy image) -->
						<svg class="w-100" viewBox="0 0 520 320" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Healthcare illustration">
							<defs>
								<linearGradient id="g1" x1="0" y1="0" x2="1" y2="1">
									<stop offset="0" stop-color="#0d6efd" stop-opacity="0.15"/>
									<stop offset="1" stop-color="#14b8a6" stop-opacity="0.15"/>
								</linearGradient>
							</defs>
							<rect x="0" y="0" width="520" height="320" fill="url(#g1)" rx="16"/>
							<g fill="none" stroke="#0d6efd" stroke-width="2" opacity="0.6">
								<rect x="40" y="40" width="180" height="110" rx="12"/>
								<line x1="55" y1="70" x2="195" y2="70"/>
								<circle cx="100" cy="110" r="18"/>
								<path d="M82 110 h36"/>
								<rect x="240" y="60" width="240" height="160" rx="14"/>
								<line x1="260" y1="96" x2="460" y2="96"/>
								<polyline points="260,140 300,130 340,150 380,120 420,160 460,140" stroke="#14b8a6"/>
								<circle cx="300" cy="200" r="12"/>
								<circle cx="420" cy="200" r="12"/>
							</g>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Services -->
	<section id="services" class="section">
		<div class="container">
			<h2 class="section-title mb-4">Our Services</h2>
			<p class="text-muted mb-5">Simple tools to access quality care when you need it.</p>
			<div class="row">
				<div class="col-md-6 col-lg-3 mb-4">
					<div class="card-lite p-4 h-100">
						<i class="fa-solid fa-calendar-check fa-lg text-primary mb-3"></i>
						<h5>Appointment Booking</h5>
						<p class="text-muted mb-0">Find doctors, pick a slot, and confirm in seconds.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 mb-4">
					<div class="card-lite p-4 h-100">
						<i class="fa-solid fa-user-doctor fa-lg text-primary mb-3"></i>
						<h5>Consultations</h5>
						<p class="text-muted mb-0">In-person or virtual consultations with specialists.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 mb-4">
					<div class="card-lite p-4 h-100">
						<i class="fa-solid fa-file-medical fa-lg text-primary mb-3"></i>
						<h5>Records</h5>
						<p class="text-muted mb-0">Manage prescriptions and visit history securely.</p>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 mb-4">
					<div class="card-lite p-4 h-100">
						<i class="fa-solid fa-clock fa-lg text-primary mb-3"></i>
						<h5>Time Slots</h5>
						<p class="text-muted mb-0">Real-time availability for faster scheduling.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- About -->
	<section id="about" class="section">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 mb-4 mb-lg-0">
					<img class="img-fluid rounded" style="box-shadow: var(--shadow); border:1px solid var(--border)" src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=1600&auto=format&fit=crop" alt="Doctors team">
				</div>
				<div class="col-lg-6">
					<h2 class="section-title mb-3">About UniCare</h2>
					<p class="text-muted">We streamline hospital appointment management and consultations with a clean, modern experience. Built to be fast, secure, and intuitive for patients and providers.</p>
					<ul class="list-unstyled mt-3 text-muted">
						<li class="mb-2"><i class="fa-solid fa-check text-primary mr-2"></i> Minimal, sleek interface</li>
						<li class="mb-2"><i class="fa-solid fa-check text-primary mr-2"></i> Doctor availability & slots</li>
						<li class="mb-2"><i class="fa-solid fa-check text-primary mr-2"></i> Easy login & onboarding</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact -->
	<section id="contact" class="section">
		<div class="container">
			<h2 class="section-title mb-4">Contact Us</h2>
			<div class="row">
				<div class="col-lg-6 mb-4 mb-lg-0">
					<div class="card-lite p-4">
						<h5 class="mb-3">Get in touch</h5>
						<p class="text-muted mb-4">Have questions about appointments or consultations? Reach out and we'll help.</p>
						<div class="d-flex align-items-center mb-2"><i class="fa-solid fa-phone text-primary mr-2"></i><span class="text-muted">+1 (555) 010-0101</span></div>
						<div class="d-flex align-items-center mb-2"><i class="fa-solid fa-envelope text-primary mr-2"></i><span class="text-muted">support@unicare.example</span></div>
						<div class="d-flex align-items-center"><i class="fa-solid fa-location-dot text-primary mr-2"></i><span class="text-muted">123 Health Blvd, Wellness City</span></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card-lite p-4">
						<form onsubmit="event.preventDefault(); alert('Message sent!');">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="name">Name</label>
									<input type="text" class="form-control" id="name" placeholder="Your name">
								</div>
								<div class="form-group col-md-6">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" placeholder="you@example.com">
								</div>
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea class="form-control" id="message" rows="4" placeholder="Type your message..."></textarea>
							</div>
							<button type="submit" class="btn btn-primary pill">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="footer py-4">
		<div class="container text-center text-muted">
			<div class="small">© {{ date('Y') }} UniCare. All rights reserved.</div>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		(function() {
			var theme = localStorage.getItem('theme') || 'light';
			document.documentElement.setAttribute('data-theme', theme);
			var btn = document.getElementById('themeToggle');
			if (btn) {
				btn.addEventListener('click', function() {
					var current = document.documentElement.getAttribute('data-theme');
					var next = current === 'dark' ? 'light' : 'dark';
					document.documentElement.setAttribute('data-theme', next);
					localStorage.setItem('theme', next);
					this.innerHTML = next === 'dark' ? '<i class="fa-regular fa-sun"></i>' : '<i class="fa-regular fa-moon"></i>';
				});
			}
		})();
	</script>
</body>
</html>
