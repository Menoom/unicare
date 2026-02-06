<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UniCare — Appointments & Consultations</title>

	<!-- Bootstrap 3 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<style>
		:root {
			--primary: #0d6efd;
			--bg: #ffffff;
			--text: #1f2937;
			--muted: #6b7280;
			--surface: #f8fafc;
			--border: #e5e7eb;
			--shadow: 0 8px 20px rgba(0,0,0,0.06);
		}
		[data-theme="dark"] {
			--primary: #5aa0ff;
			--bg: #0f172a;
			--text: #e5e7eb;
			--muted: #94a3b8;
			--surface: #111827;
			--border: #1f2937;
			--shadow: 0 8px 20px rgba(0,0,0,0.35);
		}
		* { margin: 0; padding: 0; box-sizing: border-box; }
		html, body { height: 100%; }
		body {
			font-family: 'Poppins', sans-serif;
			background: var(--bg);
			color: var(--text);
			line-height: 1.5;
			font-size: 14px;
			font-weight: 400;
		}
		/* Navbar */
		.navbar {
			box-shadow: var(--shadow);
			background: var(--bg) !important;
			border: none;
			border-bottom: 1px solid var(--border);
			margin-bottom: 0;
			min-height: 60px;
		}
		.navbar-brand {
			color: var(--primary) !important;
			font-weight: 500;
			font-size: 1.3rem;
			padding: 18px 15px;
		}
		/* Default nav links spacing and alignment (exclude CTA) */
		.navbar-nav > li > a:not(.btn-book) {
			color: var(--text) !important;
			font-weight: 400;
			font-size: 13px; /* keep consistent */
			line-height: 24px; /* ensures text sits centered */
			padding: 18px 10px; /* vertical padding harmonized with navbar height */
		}
		.navbar-nav > li > a:hover {
			color: var(--primary) !important;
			background: transparent !important;
		}
		.navbar-center {
			float: none;
			display: inline-block;
		}
		.navbar-collapse {
			text-align: center;
		}
		.navbar-right-custom {
			float: right !important;
			margin-right: 0;
		}
		/* CTA button in navbar */
		.navbar .btn-book.navbar-btn {
			background: var(--primary);
			color: #fff;
			border: none;
			padding: 8px 16px; /* pixel-based for reliability */
			border-radius: 18px;
			font-size: 13px;
			font-weight: 400;
			margin-top: 10px; /* align vertically in navbar */
			margin-right: 8px;
		}
		.btn-book:hover {
			background: #0056d2;
			color: #fff;
		}
		.toggle-btn {
			border: 1px solid var(--border);
			background: transparent;
			color: var(--text);
			padding: 8px 12px;
			border-radius: 20px;
			font-size: 0.9rem;
			margin-top: 14px;
			cursor: pointer;
		}
		.toggle-btn:hover {
			background: var(--surface);
		}
		/* Hero */
		.hero {
			background: linear-gradient(135deg, rgba(13,110,253,.10), rgba(99,102,241,.10));
			border-bottom: 1px solid var(--border);
			padding: 60px 0; /* attached banner without side margins */
			min-height: 90vh; /* make banner tall and spacious */
		}
		.hero-title {
			font-size: 5rem; /* much larger for impact */
			font-weight: 600;
			margin-top: 60px;
			margin-bottom: 20px;
			line-height: 1.1;
			letter-spacing: .2px;
		}
		.hero-sub {
			font-size: 1.5rem; /* larger subtitle */
			font-weight: 300;
			color: var(--muted);
			margin-top: 40px;
			margin-bottom: 70px;
		}
		.badge-custom {
			background: var(--primary);
			color: #fff;
			padding: 8px 17px;
			border-radius: 20px;
			font-size: 1rem;
			font-weight: 400;
			display: inline-block;
			margin-top: 12px;
			margin-bottom: -12px;
		}
		.btn-primary-custom {
			background: var(--primary);
			color: #fff;
			border: none;
			padding: 15px 30px; /* larger buttons */
			border-radius: 18px;
			font-size: 1.1rem; /* bigger font */
			font-weight: 400;
			margin-right: 15px;
			margin-bottom: 10px;
			transition: transform .15s ease, box-shadow .2s ease, background .2s ease;
		}
		.btn-outline-custom {
			background: transparent;
			color: var(--primary);
			border: 1px solid var(--primary);
			padding: 15px 30px; /* larger buttons */
			border-radius: 18px;
			font-size: 1.1rem; /* bigger font */
			font-weight: 400;
			margin-bottom: 10px;
			transition: transform .15s ease, box-shadow .2s ease, color .2s ease, background .2s ease;
		}
		.btn-primary-custom:hover {
			background: #0056d2;
			color: #fff;
			transform: translateY(-1px);
			box-shadow: 0 8px 16px rgba(13,110,253,.25);
		}
		.btn-outline-custom:hover {
			background: var(--primary);
			color: #fff;
			transform: translateY(-1px);
			box-shadow: 0 8px 16px rgba(13,110,253,.20);
		}
		/* Card hover for services */
		.card-lite { transition: box-shadow .25s ease, transform .25s ease; }
		.card-lite:hover { box-shadow: 0 14px 32px rgba(0,0,0,.12); transform: translateY(-2px); }
		/* Sections */
		.section { } /* more vertical space */
		/* About section spacing and cards */
	.section-about { padding-top: 50px; padding-bottom: 60px; }
		.section-about .container-fluid { padding-left: 30px; padding-right: 30px; }
	.section-about .section-title { margin-bottom: 26px; }
	.section-about .lead-copy { margin-bottom: 22px; }
	.about-cards { margin-top: 26px; }
	.about-cards .row { margin-left: -10px; margin-right: -10px; }
	.about-cards .col-sm-6 { padding-left: 12px; padding-right: 12px; margin-bottom: 18px; }
		.info-card {
			background: var(--bg);
			border: 1px solid var(--border);
			box-shadow: var(--shadow);
			border-radius: 12px;
			padding: 18px 20px;
			display: flex;
			align-items: center;
			gap: 10px;
		}
		.info-card i { color: var(--primary); }
		.info-card .title { font-weight: 500; font-size: 1rem; }
		.info-card .desc { color: var(--muted); font-size: 0.9rem; }
		/* Equal-height cards in Services */
		.services-row { display: flex; flex-wrap: wrap; }
		.services-row > [class*='col-'] { display: flex; }
		.section-title {
			font-weight: 600;
			font-size: 5rem; /* larger heading for Services */
			margin-top: 50px;
			margin-bottom: 30px;
			/* align via container padding, not negative margins */
		}
		.card-lite {
			background: var(--bg);
			border: 1px solid var(--border);
			box-shadow: var(--shadow);
			border-radius: 12px;
			padding: 40px; /* balanced padding across cards */
			height: 100%; /* fill column height */
			min-height: 220px; /* consistent visual height */
			mouse-pointer: cursor;
		}
		.card-lite h5 {
			font-size: 2rem; /* larger card titles */
			font-weight: 500;
			margin-top: 15px;
			margin-bottom: 10px;
		}
		.card-lite p {
			font-size: 1.1rem; /* larger descriptions */
			font-weight: 300;
			color: var(--muted);
			margin-top: 20px;
			line-height: 1.5;
			
		}
		.footer {
			border-top: 1px solid var(--border);
			padding: 30px 0;
		}
		.text-muted { color: var(--muted) !important; }
		.text-primary { color: var(--primary) !important; }
		.form-control {
			border-radius: 8px;
			border: 1px solid var(--border);
			padding: 10px;
			font-size: 0.9rem;
		}
		label {
			font-size: 0.9rem;
			font-weight: 400;
			margin-bottom: 6px;
		}
	</style>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid" style="padding-left: 30px; padding-right: 30px;">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarNav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<i class="fa-solid fa-stethoscope"></i> UniCare
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="nav navbar-nav navbar-center">
					<li><a href="#home">Home</a></li>
					<li><a href="#services">Services</a></li>
					<li><a href="#about">About Us</a></li>
					<li><a href="#contact">Contact Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right-custom">
					<li>
						<a href="/login" class="btn btn-book navbar-btn">Book Appointment</a>
					</li>
					<li>
						<button id="themeToggle" class="btn toggle-btn" title="Toggle dark mode">
							<i class="fa-regular fa-moon"></i>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Hero (full-width, attached to navbar) -->
	<section id="home" class="hero">
		<div class="container-fluid" style="padding-left:0; padding-right:0;">
	    <div class="row" style="margin-left:0; margin-right:0;">
		<div class="col-md-8 col-sm-12" style="padding-left:30px; padding-right:30px;">
						<span class="badge-custom">Appointments & Consultations</span>
			<h1 class="hero-title">Care made simple.<br>Appointments made fast.</h1>
			<p class="hero-sub">Find the right doctor, pick a convenient time, and manage your visits with ease — all in one place.</p>
						<div>
							<a href="/login" class="btn btn-primary-custom">Book Appointment</a>
							<a href="/register" class="btn btn-outline-custom">Create Account</a>
						</div>
						<p style="margin-top: 15px; font-size: 0.8rem; color: var(--muted);">Booking requires login. New here? Sign up first.</p>
		</div>
			</div>
		</div>
	</section>

	<!-- Services -->
	<section id="services" class="section">
		<div class="container-fluid" style="padding-left:30px; padding-right:30px;">
			<h2 class="section-title">Our Services</h2>
			<p class="text-muted" style="margin-bottom: 60px; font-size: 1.3rem;">Simple tools to access quality care when you need it.</p>
			<div class="row services-row">
				<div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
					<div class="card-lite">
						<i class="fa-solid fa-calendar-check text-primary" style="font-size: 2.4rem;"></i>
						<h5>Appointment Booking</h5>
						<p>Find doctors, pick a slot, and confirm in seconds.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
					<div class="card-lite">
						<i class="fa-solid fa-user-doctor text-primary" style="font-size: 2.4rem;"></i>
						<h5>Consultations</h5>
						<p>In-person or virtual consultations with specialists.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
					<div class="card-lite">
						<i class="fa-solid fa-file-medical text-primary" style="font-size: 2.4rem;"></i>
						<h5>Records</h5>
						<p>Manage prescriptions and visit history securely.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6" style="margin-bottom: 8px;">
					<div class="card-lite">
						<i class="fa-solid fa-clock text-primary" style="font-size: 2.4rem;"></i>
						<h5>Time Slots</h5>
						<p>Real-time availability for faster scheduling.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Spacer to separate Services and About -->
	<div style="height: 40px;"></div>

	<!-- About -->
	<section id="about" class="section section-about">
		<div class="container-fluid">
			<div class="row">
				<!-- Adjust left spacer column width -->
				<div class="col-md-4 col-sm-12"></div>
				<div class="col-md-8 col-sm-12">
					<h2 class="section-title">About UniCare</h2>
					<p class="text-muted lead-copy" style="font-size: 1rem;">UniCare is designed to make healthcare access simple, fast, and reliable. We focus on creating a modern experience for patients and providersfrom discovering the right specialists to booking convenient appointments and managing records securely. Whether you're scheduling an in-person visit or a virtual consultation, UniCare helps minimize friction and ensures you spend less time navigating systems and more time getting care.</p>
					<div class="about-cards" style="margin-top: 34px;">
						<div class="row">
						<div class="col-sm-6">
							<div class="info-card">
								<i class="fa-solid fa-check"></i>
								<div>
									<div class="title">Minimal, sleek interface</div>
									<div class="desc">Clean layouts and readable typography for effortless use.</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="info-card">
								<i class="fa-solid fa-clock"></i>
								<div>
									<div class="title">Doctor availability & slots</div>
									<div class="desc">Real-time schedules to find the time that works for you.</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="info-card">
								<i class="fa-solid fa-shield-halved"></i>
								<div>
									<div class="title">Secure records</div>
									<div class="desc">Encrypted and private by default for your peace of mind.</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="info-card">
								<i class="fa-solid fa-user-plus"></i>
								<div>
									<div class="title">Easy login & onboarding</div>
									<div class="desc">Fast registration and intuitive flows to get started quickly.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact -->
	<section id="contact" class="section">
		<div class="container">
			<h2 class="section-title">Contact Us</h2>
			<div class="row">
				<div class="col-md-6 col-sm-12" style="margin-bottom: 20px;">
					<div class="card-lite">
						<h5>Get in touch</h5>
						<p style="margin-bottom: 20px;">Have questions about appointments or consultations? Reach out and we'll help.</p>
						<div style="display: flex; align-items: center; margin-bottom: 10px;">
							<i class="fa-solid fa-phone text-primary" style="margin-right: 10px;"></i>
							<span class="text-muted" style="font-size: 0.9rem;">+1 (555) 010-0101</span>
						</div>
						<div style="display: flex; align-items: center; margin-bottom: 10px;">
							<i class="fa-solid fa-envelope text-primary" style="margin-right: 10px;"></i>
							<span class="text-muted" style="font-size: 0.9rem;">support@unicare.example</span>
						</div>
						<div style="display: flex; align-items: center;">
							<i class="fa-solid fa-location-dot text-primary" style="margin-right: 10px;"></i>
							<span class="text-muted" style="font-size: 0.9rem;">123 Health Blvd, Wellness City</span>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="card-lite">
						<form onsubmit="event.preventDefault(); alert('Message sent!');">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" placeholder="Your name">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email" placeholder="you@example.com">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea class="form-control" id="message" rows="4" placeholder="Type your message..."></textarea>
							</div>
							<button type="submit" class="btn btn-primary-custom">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="footer">
		<div class="container text-center">
			<p class="text-muted" style="margin: 0; font-size: 0.85rem;">© {{ date('Y') }} UniCare. All rights reserved.</p>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
