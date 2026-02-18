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
                                <label for="doctor-role">Login As</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-user-shield input-icon"></i>
                                    <select class="form-select" id="doctor-role" name="role">
                                        <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Doctor</option>
                                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staff-email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-envelope input-icon"></i>
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

                        <div class="form-footer">
                            <p>Are you a doctor? <a href="javascript:void(0)" onclick="showDoctorRegister()">Create an Account</a></p>
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

                    <!-- ===== DOCTOR REGISTRATION VIEW ===== -->
                    <div id="doctorRegisterView" style="display: none;">
                        <div class="brand-header">
                            <a href="/" class="brand-logo">
                                <i class="fa-solid fa-stethoscope"></i>
                                UniCare
                            </a>
                            <div>
                                <span class="role-badge">
                                    <i class="fa-solid fa-user-doctor"></i>
                                    Doctor Registration
                                </span>
                            </div>
                            <h1>Create Your Account</h1>
                            <p>Fill in your details to join UniCare as a doctor</p>
                        </div>

                        @if ($errors->has('doc_name') || $errors->has('doc_email') || $errors->has('doc_password') || $errors->has('doc_specialization') || $errors->has('doc_experience_years') || $errors->has('doc_consultation_fee') || $errors->has('doc_job_type'))
                            <div class="alert-errors">
                                <ul>
                                    @foreach (['doc_name','doc_email','doc_password','doc_specialization','doc_experience_years','doc_consultation_fee','doc_job_type'] as $field)
                                        @foreach ($errors->get($field) as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('doctor.register') }}" class="doctor-register-form">
                            @csrf

                            <div class="form-section-label">Personal Information</div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="doc-name">Full Name</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" class="form-input" id="doc-name" name="doc_name" value="{{ old('doc_name') }}" placeholder="Dr. John Doe" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="doc-email">Email Address</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input type="email" class="form-input" id="doc-email" name="doc_email" value="{{ old('doc_email') }}" placeholder="doctor@unicare.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="doc-password">Password</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input type="password" class="form-input" id="doc-password" name="doc_password" placeholder="Min 8 characters" required>
                                        <button type="button" class="password-toggle" onclick="togglePassword('doc-password', this)" aria-label="Toggle password visibility">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="doc-password-confirm">Confirm Password</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" class="form-input" id="doc-password-confirm" name="doc_password_confirmation" placeholder="Re-enter password" required>
                                </div>
                            </div>

                            <div class="form-section-label">Professional Details</div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="doc-specialization">Specialization</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-stethoscope input-icon"></i>
                                        <input type="text" class="form-input" id="doc-specialization" name="doc_specialization" value="{{ old('doc_specialization') }}" placeholder="e.g. Cardiologist" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="doc-job-type">Job Type</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-hospital input-icon"></i>
                                        <select class="form-select" id="doc-job-type" name="doc_job_type" required>
                                            <option value="">Select type</option>
                                            <option value="private" {{ old('doc_job_type') === 'private' ? 'selected' : '' }}>Private Practice</option>
                                            <option value="hospital_based" {{ old('doc_job_type') === 'hospital_based' ? 'selected' : '' }}>Hospital Based</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="doc-experience">Experience (Years)</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-briefcase-medical input-icon"></i>
                                        <input type="number" class="form-input" id="doc-experience" name="doc_experience_years" value="{{ old('doc_experience_years') }}" placeholder="e.g. 5" min="0" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="doc-fee">Consultation Fee ($)</label>
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-dollar-sign input-icon"></i>
                                        <input type="number" class="form-input" id="doc-fee" name="doc_consultation_fee" value="{{ old('doc_consultation_fee') }}" placeholder="e.g. 100" min="0" step="0.01" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <span class="btn-text">Create Doctor Account</span>
                                <span class="spinner"></span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>

                        <div class="security-badge">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Your data is securely encrypted</span>
                        </div>

                        <div class="form-footer">
                            <p>Already have an account? <a href="javascript:void(0)" onclick="showStaffLogin()">Sign In</a></p>
                        </div>

                        <div class="mobile-switcher">
                            <button class="btn-mobile-switch" onclick="togglePanel()">
                                <i class="fa-solid fa-user"></i>
                                Patient Login
                            </button>
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

    <!-- =====================
         OTP VERIFICATION MODAL
         ===================== -->
    <div class="otp-modal-overlay" id="otpModalOverlay">
        <div class="otp-modal">
            <button class="otp-modal-close" id="otpModalClose" title="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="otp-modal-header">
                <div class="otp-icon-wrapper">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                </div>
                <h2>Verify Your Email</h2>
                <p>We've sent a 6-digit OTP to<br><strong id="otpEmailDisplay"></strong></p>
            </div>

            <div class="otp-alert otp-alert-error" id="otpError" style="display:none;">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span id="otpErrorText"></span>
            </div>

            <div class="otp-alert otp-alert-success" id="otpSuccess" style="display:none;">
                <i class="fa-solid fa-circle-check"></i>
                <span id="otpSuccessText"></span>
            </div>

            <div class="otp-inputs" id="otpInputs">
                <input type="text" maxlength="1" class="otp-digit" data-index="0" inputmode="numeric" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit" data-index="1" inputmode="numeric" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit" data-index="2" inputmode="numeric" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit" data-index="3" inputmode="numeric" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit" data-index="4" inputmode="numeric" autocomplete="off">
                <input type="text" maxlength="1" class="otp-digit" data-index="5" inputmode="numeric" autocomplete="off">
            </div>

            <div class="otp-timer" id="otpTimerSection">
                <i class="fa-regular fa-clock"></i>
                <span>Expires in <strong id="otpTimerDisplay">2:00</strong></span>
            </div>

            <div class="otp-expired" id="otpExpiredSection" style="display:none;">
                <p>OTP has expired.</p>
                <button class="btn-resend-otp" id="btnResendOtp">
                    <i class="fa-solid fa-rotate-right"></i> Resend OTP
                </button>
            </div>

            <button class="btn-verify-otp" id="btnVerifyOtp">
                <span class="btn-text">Verify &amp; Create Account</span>
                <span class="spinner"></span>
            </button>
        </div>
    </div>

    <script>
        // ==========================================
        // PANEL & VIEW TOGGLES
        // ==========================================
        function togglePanel() {
            document.getElementById('loginContainer').classList.toggle('active');
            var pp = document.getElementById('panelPatient');
            var pd = document.getElementById('panelDoctor');
            pp.classList.toggle('mobile-active');
            pd.classList.toggle('mobile-active');
        }

        function showDoctorRegister() {
            document.getElementById('staffLoginView').style.display = 'none';
            document.getElementById('doctorRegisterView').style.display = 'block';
        }

        function showStaffLogin() {
            document.getElementById('doctorRegisterView').style.display = 'none';
            document.getElementById('staffLoginView').style.display = 'block';
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

        // Loading state for non-doctor-register forms
        document.querySelectorAll('form:not(.doctor-register-form)').forEach(function(f) {
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

        @if ($errors->has('doc_name') || $errors->has('doc_email') || $errors->has('doc_password') || $errors->has('doc_specialization') || $errors->has('doc_experience_years') || $errors->has('doc_consultation_fee') || $errors->has('doc_job_type'))
            togglePanel();
            showDoctorRegister();
        @endif

        // ==========================================
        // OTP MODAL LOGIC
        // ==========================================
        var otpTimerInterval = null;

        // Elements
        var otpOverlay = document.getElementById('otpModalOverlay');
        var otpCloseBtn = document.getElementById('otpModalClose');
        var otpDigits = document.querySelectorAll('.otp-digit');
        var otpEmailDisplay = document.getElementById('otpEmailDisplay');
        var otpTimerDisplay = document.getElementById('otpTimerDisplay');
        var otpTimerSection = document.getElementById('otpTimerSection');
        var otpExpiredSection = document.getElementById('otpExpiredSection');
        var otpError = document.getElementById('otpError');
        var otpErrorText = document.getElementById('otpErrorText');
        var otpSuccess = document.getElementById('otpSuccess');
        var otpSuccessText = document.getElementById('otpSuccessText');
        var btnVerify = document.getElementById('btnVerifyOtp');
        var btnResend = document.getElementById('btnResendOtp');

        // CSRF token
        var csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                        || document.querySelector('input[name="_token"]')?.value;

        // Open OTP modal
        function openOtpModal(email) {
            otpEmailDisplay.textContent = email;
            otpOverlay.classList.add('active');
            resetOtpInputs();
            hideOtpAlerts();
            otpTimerSection.style.display = 'flex';
            otpExpiredSection.style.display = 'none';
            btnVerify.disabled = false;
            btnVerify.classList.remove('loading');
            startOtpTimer(120); // 2 minutes
            otpDigits[0].focus();
        }

        // Close OTP modal
        function closeOtpModal() {
            otpOverlay.classList.remove('active');
            clearInterval(otpTimerInterval);
        }

        otpCloseBtn.addEventListener('click', closeOtpModal);
        otpOverlay.addEventListener('click', function(e) {
            if (e.target === otpOverlay) closeOtpModal();
        });

        // Reset OTP inputs
        function resetOtpInputs() {
            otpDigits.forEach(function(d) { d.value = ''; });
        }

        // Hide alerts
        function hideOtpAlerts() {
            otpError.style.display = 'none';
            otpSuccess.style.display = 'none';
        }

        // Show error
        function showOtpError(msg) {
            otpSuccess.style.display = 'none';
            otpErrorText.textContent = msg;
            otpError.style.display = 'flex';
        }

        // Show success
        function showOtpSuccess(msg) {
            otpError.style.display = 'none';
            otpSuccessText.textContent = msg;
            otpSuccess.style.display = 'flex';
        }

        // OTP Timer
        function startOtpTimer(seconds) {
            clearInterval(otpTimerInterval);
            var remaining = seconds;
            updateTimerDisplay(remaining);
            otpTimerSection.style.display = 'flex';
            otpExpiredSection.style.display = 'none';

            otpTimerInterval = setInterval(function() {
                remaining--;
                updateTimerDisplay(remaining);
                if (remaining <= 0) {
                    clearInterval(otpTimerInterval);
                    otpTimerSection.style.display = 'none';
                    otpExpiredSection.style.display = 'flex';
                    btnVerify.disabled = true;
                }
            }, 1000);
        }

        function updateTimerDisplay(seconds) {
            var m = Math.floor(seconds / 60);
            var s = seconds % 60;
            otpTimerDisplay.textContent = m + ':' + (s < 10 ? '0' : '') + s;
        }

        // OTP input navigation (auto-focus next, handle backspace, paste)
        otpDigits.forEach(function(input, idx) {
            input.addEventListener('input', function(e) {
                var val = this.value.replace(/\D/g, '');
                this.value = val.charAt(0) || '';
                if (val && idx < otpDigits.length - 1) {
                    otpDigits[idx + 1].focus();
                }
                // Auto-submit when all 6 filled
                if (getOtpValue().length === 6) {
                    hideOtpAlerts();
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && idx > 0) {
                    otpDigits[idx - 1].focus();
                }
            });

            input.addEventListener('paste', function(e) {
                e.preventDefault();
                var pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
                for (var i = 0; i < 6 && i < pasted.length; i++) {
                    otpDigits[i].value = pasted.charAt(i);
                }
                var focusIdx = Math.min(pasted.length, 5);
                otpDigits[focusIdx].focus();
            });
        });

        function getOtpValue() {
            return Array.from(otpDigits).map(function(d) { return d.value; }).join('');
        }

        // ==========================================
        // DOCTOR REGISTER FORM — AJAX SUBMIT → SEND OTP
        // ==========================================
        var docForm = document.querySelector('.doctor-register-form');
        docForm.addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(docForm);
            var submitBtn = docForm.querySelector('.btn-submit');
            submitBtn.classList.add('loading');

            fetch('{{ route("doctor.register") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(function(res) { return res.json().then(function(data) { return { ok: res.ok, data: data }; }); })
            .then(function(result) {
                submitBtn.classList.remove('loading');
                if (result.ok && result.data.success) {
                    // Open OTP modal
                    var email = docForm.querySelector('#doc-email').value;
                    openOtpModal(email);
                } else {
                    // Show validation errors on the form
                    var errors = result.data.errors || {};
                    var msgs = [];
                    for (var key in errors) {
                        errors[key].forEach(function(m) { msgs.push(m); });
                    }
                    if (result.data.message && !Object.keys(errors).length) {
                        msgs.push(result.data.message);
                    }
                    // Show in an alert above the form
                    var alertBox = document.querySelector('#doctorRegisterView .alert-errors');
                    if (!alertBox) {
                        alertBox = document.createElement('div');
                        alertBox.className = 'alert-errors';
                        var brandHeader = document.querySelector('#doctorRegisterView .brand-header');
                        brandHeader.insertAdjacentElement('afterend', alertBox);
                    }
                    alertBox.innerHTML = '<ul>' + msgs.map(function(m) { return '<li>' + m + '</li>'; }).join('') + '</ul>';
                    alertBox.style.display = 'block';
                }
            })
            .catch(function(err) {
                submitBtn.classList.remove('loading');
                console.error('Registration error:', err);
            });
        });

        // ==========================================
        // VERIFY OTP
        // ==========================================
        btnVerify.addEventListener('click', function() {
            hideOtpAlerts();
            var otp = getOtpValue();
            if (otp.length !== 6) {
                showOtpError('Please enter all 6 digits.');
                return;
            }

            btnVerify.classList.add('loading');
            btnVerify.disabled = true;

            fetch('{{ route("doctor.verify.otp") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ otp: otp }),
            })
            .then(function(res) { return res.json().then(function(data) { return { ok: res.ok, data: data }; }); })
            .then(function(result) {
                if (result.ok && result.data.success) {
                    showOtpSuccess('Verified! Redirecting to your dashboard…');
                    clearInterval(otpTimerInterval);
                    setTimeout(function() {
                        window.location.href = result.data.redirect;
                    }, 1200);
                } else {
                    btnVerify.classList.remove('loading');
                    btnVerify.disabled = false;

                    if (result.data.expired) {
                        otpTimerSection.style.display = 'none';
                        otpExpiredSection.style.display = 'flex';
                        btnVerify.disabled = true;
                        clearInterval(otpTimerInterval);
                    }
                    showOtpError(result.data.message || 'Verification failed.');
                }
            })
            .catch(function(err) {
                btnVerify.classList.remove('loading');
                btnVerify.disabled = false;
                showOtpError('Something went wrong. Please try again.');
                console.error('OTP verify error:', err);
            });
        });

        // ==========================================
        // RESEND OTP
        // ==========================================
        btnResend.addEventListener('click', function() {
            hideOtpAlerts();
            btnResend.disabled = true;
            btnResend.textContent = 'Sending…';

            fetch('{{ route("doctor.resend.otp") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(function(res) { return res.json().then(function(data) { return { ok: res.ok, data: data }; }); })
            .then(function(result) {
                btnResend.disabled = false;
                btnResend.innerHTML = '<i class="fa-solid fa-rotate-right"></i> Resend OTP';

                if (result.ok && result.data.success) {
                    showOtpSuccess(result.data.message);
                    resetOtpInputs();
                    startOtpTimer(120);
                    btnVerify.disabled = false;
                    otpDigits[0].focus();
                } else {
                    showOtpError(result.data.message || 'Failed to resend OTP.');
                }
            })
            .catch(function(err) {
                btnResend.disabled = false;
                btnResend.innerHTML = '<i class="fa-solid fa-rotate-right"></i> Resend OTP';
                showOtpError('Something went wrong. Please try again.');
                console.error('Resend error:', err);
            });
        });
    </script>

</body>
</html>
