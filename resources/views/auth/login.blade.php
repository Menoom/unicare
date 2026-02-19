<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - UniCare</title>
    <meta name="description" content="Login to UniCare — patients book appointments, doctors and admins manage their practice.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/auth-login-blade.css'])
</head>
<body>

    <!-- Back to Home -->
    <a href="/" class="back-home" id="backHome">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Home</span>
    </a>

    <div class="login-container" id="loginContainer">
        <div class="panels-wrapper">

            <!-- =====================
                 PATIENT LOGIN PANEL
                 ===================== -->
            <div class="panel panel-patient mobile-active" id="panelPatient">
                <div class="panel-bg">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="grid-pattern"></div>
                </div>

                <div class="form-wrapper">
                    <div class="brand-header">
                        <a href="/" class="brand-logo">
                            <i class="fa-solid fa-stethoscope"></i>
                            UniCare
                        </a>
                        <div>
                            <span class="role-badge">
                                <i class="fa-solid fa-user"></i>
                                Patient Portal
                            </span>
                        </div>
                        <h1>Welcome Back</h1>
                        <p>Sign in to book appointments &amp; manage your health</p>
                    </div>

                    @if ($errors->has('email') && old('login_type') === 'patient')
                        <div class="alert-errors">
                            <ul>
                                @foreach ($errors->get('email') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="login_type" value="patient">

                        <div class="form-group">
                            <label for="patient-email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" class="form-input" id="patient-email" name="email" value="{{ old('login_type') === 'patient' ? old('email') : '' }}" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="patient-password">Password</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" class="form-input" id="patient-password" name="password" placeholder="Enter your password" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('patient-password', this)" aria-label="Toggle password visibility">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="patient-remember" name="remember">
                            <label for="patient-remember">Remember me for 30 days</label>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span class="btn-text">Sign In</span>
                            <span class="spinner"></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>

                    <div class="security-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>256-bit SSL encrypted connection</span>
                    </div>

                    <div class="form-footer">
                        <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
                    </div>

                    <div class="mobile-switcher">
                        <button class="btn-mobile-switch" onclick="togglePanel()">
                            <i class="fa-solid fa-user-doctor"></i>
                            Doctor / Admin Login
                        </button>
                    </div>
                </div>
            </div>

            <!-- =====================
                 DOCTOR / ADMIN LOGIN PANEL
                 ===================== -->
            <div class="panel panel-doctor" id="panelDoctor">
                <div class="panel-bg">
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="grid-pattern"></div>
                </div>

                <div class="form-wrapper">
                    <!-- ===== STAFF LOGIN VIEW ===== -->
                    <div id="staffLoginView">
                        <div class="brand-header">
                            <a href="/" class="brand-logo">
                                <i class="fa-solid fa-stethoscope"></i>
                                UniCare
                            </a>
                            <div>
                                <span class="role-badge">
                                    <i class="fa-solid fa-user-doctor"></i>
                                    Staff Portal
                                </span>
                            </div>
                            <h1>Staff Access</h1>
                            <p>Sign in to manage appointments, patients &amp; records</p>
                        </div>

                        @if ($errors->has('staff_email') || $errors->has('staff_password'))
                            <div class="alert-errors">
                                <ul>
                                    @foreach ($errors->get('staff_email') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    @foreach ($errors->get('staff_password') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="login_type" value="staff">

                            <div class="form-group">
                                <label for="staff-email">Doctor ID</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-id-badge input-icon"></i>
                                    <input type="email" class="form-input" id="staff-email" name="email" value="{{ old('email') }}" placeholder="you@unicare.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staff-password">Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="staff-password" name="password" placeholder="Enter your password" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('staff-password', this)" aria-label="Toggle password visibility">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="staff-remember" name="remember">
                                <label for="staff-remember">Remember me for 30 days</label>
                            </div>

                            <button type="submit" class="btn-submit">
                                <span class="btn-text">Access Dashboard</span>
                                <span class="spinner"></span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>

                        <div class="security-badge">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>HIPAA-compliant secure login</span>
                        </div>

                        <div class="mobile-switcher">
                            <button class="btn-mobile-switch" onclick="togglePanel()">
                                <i class="fa-solid fa-user"></i>
                                Patient Login
                            </button>
                        </div>

                        <div class="admin-contact-note">
                            <p><i class="fa-solid fa-circle-info"></i> Need staff access? <a href="mailto:admin@unicare.com" style="color: var(--accent); text-decoration: underline;">Contact admin</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- =====================
             SLIDING OVERLAY
             ===================== -->
        <div class="overlay-container" id="overlayContainer">
            <div class="overlay">

                <!-- LEFT HALF — visible when overlay slides left (active state)
                     Covers patient panel → shows "Looking for Care?" to entice back to patient -->
                <div class="overlay-half overlay-go-patient">
                    <div class="floating-icons">
                        <i class="fa-solid fa-heart-pulse floating-icon"></i>
                        <i class="fa-solid fa-syringe floating-icon"></i>
                        <i class="fa-solid fa-pills floating-icon"></i>
                        <i class="fa-solid fa-dna floating-icon"></i>
                        <i class="fa-solid fa-lungs floating-icon"></i>
                        <i class="fa-solid fa-vial floating-icon"></i>
                    </div>

                    <svg class="pulse-line" viewBox="0 0 600 100" preserveAspectRatio="none">
                        <path d="M0,50 L100,50 L130,20 L160,80 L190,30 L220,70 L250,50 L350,50 L380,15 L410,85 L440,25 L470,75 L500,50 L600,50" />
                    </svg>

                    <div class="overlay-content">
                        <i class="fa-solid fa-hospital-user overlay-icon-large icon-patient"></i>
                        <h2>Looking for Care?</h2>
                        <p>Book appointments with top specialists, access your medical history, and manage your health journey.</p>

                        <div class="overlay-features">
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <span>Find the right specialist for you</span>
                            </div>
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-clock"></i></span>
                                <span>Book in seconds, any time</span>
                            </div>
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-file-medical"></i></span>
                                <span>Secure digital health records</span>
                            </div>
                        </div>

                        <button class="btn-switch btn-switch-patient" onclick="togglePanel()" id="btnGoPatient">
                            Staff Login <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- RIGHT HALF — visible by default (covers doctor panel)
                     Shows "Are You a Doctor or Admin?" to entice switching to staff -->
                <div class="overlay-half overlay-go-doctor">
                    <div class="floating-icons">
                        <i class="fa-solid fa-stethoscope floating-icon"></i>
                        <i class="fa-solid fa-microscope floating-icon"></i>
                        <i class="fa-solid fa-user-doctor floating-icon"></i>
                        <i class="fa-solid fa-clipboard-list floating-icon"></i>
                        <i class="fa-solid fa-chart-line floating-icon"></i>
                        <i class="fa-solid fa-hospital floating-icon"></i>
                    </div>

                    <svg class="pulse-line" viewBox="0 0 600 100" preserveAspectRatio="none">
                        <path d="M0,50 L100,50 L130,20 L160,80 L190,30 L220,70 L250,50 L350,50 L380,15 L410,85 L440,25 L470,75 L500,50 L600,50" />
                    </svg>

                    <div class="overlay-content">
                        <i class="fa-solid fa-user-doctor overlay-icon-large icon-doctor"></i>
                        <h2>Are You a Doctor<br>or Admin?</h2>
                        <p>Access your professional dashboard to manage patient appointments, schedules, and medical records.</p>

                        <div class="overlay-features">
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-calendar-check"></i></span>
                                <span>Manage appointment schedules</span>
                            </div>
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-clipboard-list"></i></span>
                                <span>View patient records securely</span>
                            </div>
                            <div class="overlay-feature">
                                <span class="feat-icon"><i class="fa-solid fa-chart-line"></i></span>
                                <span>Analytics &amp; practice insights</span>
                            </div>
                        </div>

                        <button class="btn-switch btn-switch-doctor" onclick="togglePanel()" id="btnGoDoctor">
                            Patient Login <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        // ==========================================
        // PANEL TOGGLE
        // ==========================================
        function togglePanel() {
            document.getElementById('loginContainer').classList.toggle('active');
            var pp = document.getElementById('panelPatient');
            var pd = document.getElementById('panelDoctor');
            pp.classList.toggle('mobile-active');
            pd.classList.toggle('mobile-active');
        }

        function togglePassword(id, btn) {
            var inp = document.getElementById(id);
            var ico = btn.querySelector('i');
            if (inp.type === 'password') {
                inp.type = 'text';
                ico.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                inp.type = 'password';
                ico.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Loading state for forms
        document.querySelectorAll('form').forEach(function(f) {
            f.addEventListener('submit', function() {
                var btn = f.querySelector('.btn-submit');
                if (btn) btn.classList.add('loading');
            });
        });

        // Alt+S keyboard shortcut
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 's') { e.preventDefault(); togglePanel(); }
        });

        @if ($errors->has('staff_email') || $errors->has('staff_password'))
            togglePanel();
        @endif
    </script>

</body>
</html>
