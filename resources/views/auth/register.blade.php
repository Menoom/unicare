<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - UniCare</title>
    <meta name="description" content="Create your UniCare account — patients register to book appointments, staff register to manage the practice.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/auth-register-blade.css'])
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
                 PATIENT REGISTRATION PANEL
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
                                Patient Registration
                            </span>
                        </div>
                        <h1>Create Account</h1>
                        <p>Sign up to start booking appointments</p>
                    </div>

                    @if ($errors->any() && old('register_type') !== 'staff')
                        <div class="alert-errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="patientRegisterForm">
                        @csrf
                        <input type="hidden" name="register_type" value="patient">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="patient-name">Full Name</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-user input-icon"></i>
                                    <input type="text" class="form-input" id="patient-name" name="name" value="{{ old('register_type') !== 'staff' ? old('name') : '' }}" placeholder="John Doe" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="patient-phone">Phone <span style="color:var(--text-muted);font-weight:300">(optional)</span></label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-phone input-icon"></i>
                                    <input type="tel" class="form-input" id="patient-phone" name="phone" value="{{ old('register_type') !== 'staff' ? old('phone') : '' }}" placeholder="+1 555-010-0101">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="patient-email">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" class="form-input" id="patient-email" name="email" value="{{ old('register_type') !== 'staff' ? old('email') : '' }}" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="patient-password">Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="patient-password" name="password" placeholder="Min. 8 characters" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('patient-password', this)" aria-label="Toggle password visibility">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="patient-password-confirm">Confirm Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="patient-password-confirm" name="password_confirmation" placeholder="Re-enter password" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="patient-terms" name="terms" required>
                            <label for="patient-terms">I agree to the <a href="#" style="color:var(--patient-primary);">Terms of Service</a> and <a href="#" style="color:var(--patient-primary);">Privacy Policy</a></label>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span class="btn-text">Create Account</span>
                            <i class="fa-solid fa-arrow-right"></i>
                            <span class="spinner"></span>
                        </button>
                    </form>

                    <div class="security-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Your data is encrypted &amp; secure</span>
                    </div>

                    <div class="form-footer">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                    </div>

                    <div class="mobile-switcher">
                        <button class="btn-mobile-switch" onclick="togglePanel()">
                            <i class="fa-solid fa-user-doctor"></i>
                            Doctor / Admin Registration
                        </button>
                    </div>
                </div>
            </div>

            <!-- =====================
                 DOCTOR / ADMIN REGISTRATION PANEL
                 ===================== -->
            <div class="panel panel-doctor" id="panelDoctor">
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
                                <i class="fa-solid fa-user-doctor"></i>
                                Staff Registration
                            </span>
                        </div>
                        <h1>Staff Sign Up</h1>
                        <p>Create your professional account to get started</p>
                    </div>

                    @if ($errors->any() && old('register_type') === 'staff')
                        <div class="alert-errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="doctorRegisterForm">
                        @csrf
                        <input type="hidden" name="register_type" value="staff">

                        <div class="form-group">
                            <label for="doctor-role">Register As</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user-shield input-icon"></i>
                                <select class="form-select" id="doctor-role" name="role">
                                    <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Doctor</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="doctor-name">Full Name</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-user input-icon"></i>
                                    <input type="text" class="form-input" id="doctor-name" name="name" value="{{ old('register_type') === 'staff' ? old('name') : '' }}" placeholder="Dr. Jane Smith" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="doctor-phone">Phone</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-phone input-icon"></i>
                                    <input type="tel" class="form-input" id="doctor-phone" name="phone" value="{{ old('register_type') === 'staff' ? old('phone') : '' }}" placeholder="+1 555-010-0101">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="doctor-email">Staff Email</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-envelope input-icon"></i>
                                <input type="email" class="form-input" id="doctor-email" name="email" value="{{ old('register_type') === 'staff' ? old('email') : '' }}" placeholder="doctor@unicare.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="doctor-password">Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="doctor-password" name="password" placeholder="Min. 8 characters" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword('doctor-password', this)" aria-label="Toggle password visibility">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="doctor-password-confirm">Confirm Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="doctor-password-confirm" name="password_confirmation" placeholder="Re-enter password" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="doctor-terms" name="terms" required>
                            <label for="doctor-terms">I agree to the <a href="#" style="color:var(--doctor-primary);">Terms of Service</a> and <a href="#" style="color:var(--doctor-primary);">Privacy Policy</a></label>
                        </div>

                        <button type="submit" class="btn-submit">
                            <span class="btn-text">Create Staff Account</span>
                            <i class="fa-solid fa-arrow-right"></i>
                            <span class="spinner"></span>
                        </button>
                    </form>

                    <div class="security-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>HIPAA-compliant secure registration</span>
                    </div>

                    <div class="form-footer">
                        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                    </div>

                    <div class="mobile-switcher">
                        <button class="btn-mobile-switch" onclick="togglePanel()">
                            <i class="fa-solid fa-user"></i>
                            Patient Registration
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- =====================
             SLIDING OVERLAY
             ===================== -->
        <div class="overlay-container" id="overlayContainer">
            <div class="overlay">

                <!-- LEFT HALF — covers patient panel when active
                     Shows "Looking for Care?" to bring user back to patient registration -->
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
                        <p>Create your patient account to book appointments, find specialists, and manage your health records.</p>

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
                            Staff Sign Up <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- RIGHT HALF — visible by default (covers doctor panel)
                     Shows "Are You a Doctor or Admin?" to entice staff registration -->
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
                        <p>Register your professional account to manage appointments, patients, and medical records.</p>

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
                            Patient Sign Up <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        // Toggle between panels
        function togglePanel() {
            document.getElementById('loginContainer').classList.toggle('active');

            var pp = document.getElementById('panelPatient');
            var pd = document.getElementById('panelDoctor');
            pp.classList.toggle('mobile-active');
            pd.classList.toggle('mobile-active');
        }

        // Password visibility
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

        // Loading state on submit
        document.querySelectorAll('form').forEach(function(f) {
            f.addEventListener('submit', function() {
                var btn = f.querySelector('.btn-submit');
                if (btn) btn.classList.add('loading');
            });
        });

        // Alt+S keyboard shortcut to switch panels
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 's') { e.preventDefault(); togglePanel(); }
        });

        // If staff errors came back, auto-switch to staff panel
        @if ($errors->any() && old('register_type') === 'staff')
            togglePanel();
        @endif
    </script>

</body>
</html>
