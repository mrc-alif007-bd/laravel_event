<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sign Up | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    <style>
        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background-color: #dc3545;
            width: 33%;
        }

        .strength-medium {
            background-color: #ffc107;
            width: 66%;
        }

        .strength-strong {
            background-color: #28a745;
            width: 100%;
        }

        .password-match {
            font-size: 12px;
            margin-top: 5px;
        }

        .match-success {
            color: #28a745;
        }

        .match-error {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="/" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-success">
                            <div class="text-success text-center p-4">
                                <h5 class="text-white font-size-20">Create Account</h5>
                                <p class="text-white-50">Get started with your free account.</p>
                                <a href="/" class="logo logo-admin">
                                    <img src="assets/images/logo-sm.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form method="POST" action="{{ route('user.register') }}" id="register-form">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="name">Full Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                id="name" placeholder="Enter your full name"
                                                value="{{ old('name') }}" required autofocus>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email Address <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" placeholder="Enter your email"
                                                value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="phone">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                id="phone" placeholder="Enter your phone number"
                                                value="{{ old('phone') }}">
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Enter password" required
                                                onkeyup="checkPasswordStrength()">
                                        </div>
                                        <div class="password-strength" id="password-strength"></div>
                                        <small class="text-muted">Minimum 8 characters with at least one number and one
                                            letter</small>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Confirm your password"
                                                required onkeyup="checkPasswordMatch()">
                                        </div>
                                        <div id="password-match-message" class="password-match"></div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                class="form-check-input @error('terms') is-invalid @enderror"
                                                name="terms" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a href="#" class="text-primary">Terms of
                                                    Service</a> and
                                                <a href="#" class="text-primary">Privacy Policy</a>
                                            </label>
                                            @error('terms')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success waves-effect waves-light" type="submit"
                                            id="register-btn">
                                            <i class="fas fa-user-plus me-1"></i> Register
                                        </button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Already have an account?
                                            <a href="{{ route('user.login') }}" class="fw-medium text-primary">
                                                Sign in
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Error Display -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('password-strength');

            let strength = 0;

            if (password.length >= 8) strength += 1;
            if (password.length >= 10) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[a-zA-Z]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

            strengthBar.className = 'password-strength';

            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthBar.classList.remove('strength-weak', 'strength-medium', 'strength-strong');
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchMessage = document.getElementById('password-match-message');

            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    matchMessage.innerHTML = '<i class="fas fa-check-circle"></i> Passwords match';
                    matchMessage.className = 'password-match match-success';
                } else {
                    matchMessage.innerHTML = '<i class="fas fa-exclamation-circle"></i> Passwords do not match';
                    matchMessage.className = 'password-match match-error';
                }
            } else {
                matchMessage.innerHTML = '';
            }
        }

        document.getElementById('register-form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return;
            }

            if (!terms) {
                e.preventDefault();
                alert('Please accept the Terms and Conditions');
                return;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long');
                return;
            }
        });

        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            });
        }, 5000);
    </script>
</body>

</html>
