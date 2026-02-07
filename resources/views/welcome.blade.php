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
	@vite(['resources/css/app.css'])
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid pad-lr-30">
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
		<div class="container-fluid no-hpad">
			<div class="row no-hmargin">
				<div class="col-md-8 col-sm-12 col-pad-30">
					<span class="badge-custom">Appointments & Consultations</span>
					<h1 class="hero-title">Care made simple.<br>Appointments made fast.</h1>
					<p class="hero-sub">Find the right doctor, pick a convenient time, and manage your visits with ease — all in one place.</p>
					<div>
						<a href="/login" class="btn btn-primary-custom">Book Appointment</a>
						<a href="/register" class="btn btn-outline-custom">Create Account</a>
					</div>
					<p class="hero-note">Booking requires login. New here? Sign up first.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Services -->
	<section id="services" class="section">
	<div class="container-fluid pad-lr-30">
			<h2 class="section-title">Our Services</h2>
			<p class="text-muted mb-60 section-subtitle">Simple tools to access quality care when you need it.</p>
			<div class="row services-row">
				<div class="col-md-3 col-sm-6 card-col">
					<div class="card-lite">
						<i class="fa-solid fa-calendar-check text-primary icon-xl"></i>
						<h5>Appointment Booking</h5>
						<p>Find doctors, pick a slot, and confirm in seconds.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 card-col">
					<div class="card-lite">
						<i class="fa-solid fa-user-doctor text-primary icon-xl"></i>
						<h5>Consultations</h5>
						<p>In-person or virtual consultations with specialists.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 card-col">
					<div class="card-lite">
						<i class="fa-solid fa-file-medical text-primary icon-xl"></i>
						<h5>Records</h5>
						<p>Manage prescriptions and visit history securely.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 card-col">
					<div class="card-lite">
						<i class="fa-solid fa-clock text-primary icon-xl"></i>
						<h5>Time Slots</h5>
						<p>Real-time availability for faster scheduling.</p>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- About -->
	<section id="about" class="section section-about">
	<div class="container-fluid">
			<div class="row">
				<!-- Adjust left spacer column width -->
				<div class="col-md-4 col-sm-12"></div>
				<div class="col-md-8 col-sm-12">
					<h2 class="section-title">About UniCare</h2>
					<p class="text-muted lead-copy" style="font-size: 1.2rem;">UniCare is designed to make healthcare access simple, fast, and reliable. We focus on creating a modern experience for patients and providersfrom discovering the right specialists to booking convenient appointments and managing records securely. Whether you're scheduling an in-person visit or a virtual consultation, UniCare helps minimize friction and ensures you spend less time navigating systems and more time getting care.</p>
					<div class="about-cards">
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
				<div class="col-md-6 col-sm-12 mb-20">
					<div class="card-lite">
						<h5>Get in touch</h5>
						<p class="contact-intro">Have questions about appointments or consultations? Reach out and we'll help.</p>
						<div class="contact-line">
							<i class="fa-solid fa-phone text-primary"></i>
							<span class="text-muted contact-text">+1 (555) 010-0101</span>
						</div>
						<div class="contact-line">
							<i class="fa-solid fa-envelope text-primary"></i>
							<span class="text-muted contact-text">support@unicare.example</span>
						</div>
						<div class="contact-line">
							<i class="fa-solid fa-location-dot text-primary"></i>
							<span class="text-muted contact-text">123 Health Blvd, Wellness City</span>
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
			<p class="text-muted footer-note">© {{ date('Y') }} UniCare. All rights reserved.</p>
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
