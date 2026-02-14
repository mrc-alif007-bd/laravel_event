<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

    <style>
        .login-type-selector {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .login-type-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }

        .login-type-btn.active {
            border-color: #556ee6;
            background-color: #f8f9fa;
        }

        .login-type-btn i {
            font-size: 24px;
            display: block;
            margin-bottom: 5px;
        }

        .login-type-btn.user-active {
            border-color: #28a745;
        }

        .login-type-btn.admin-active {
            border-color: #dc3545;
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
                        <div class="bg-primary" id="login-header">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20" id="login-title">User Login</h5>
                                <p class="text-white-50" id="login-subtitle">Sign in as User to continue.</p>
                                <a href="/" class="logo logo-admin">
                                    <img src="{{ asset('assets/img/logo/logo.png') }}" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <!-- Login Type Selector -->
                            <div class="login-type-selector">
                                <div class="login-type-btn" id="user-login-btn" onclick="setLoginType('user')">
                                    <i class="fas fa-user"></i>
                                    <span>User Login</span>
                                </div>
                                <div class="login-type-btn" id="admin-login-btn" onclick="setLoginType('admin')">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Admin Login</span>
                                </div>
                            </div>

                            <div class="p-3">
                                <!-- User Login Form -->
                                <form method="POST" action="{{ route('user.login') }}" id="user-login-form"
                                    style="display: block;">
                                    @csrf
                                    <input type="hidden" name="login_type" value="user">
                                    <div class="mb-3">
                                        <label class="form-label" for="user-email">Email</label>
                                        <input type="email" name="email"
                                            value="{{ old('login_type') === 'user' ? old('email') : '' }}"
                                            class="form-control @error('email') is-invalid @enderror" id="user-email"
                                            placeholder="Enter email" required>
                                        @if (old('login_type') === 'user')
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="user-password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="user-password" placeholder="Enter password" required>
                                        @if (old('login_type') === 'user')
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                    id="user-remember">
                                                <label class="form-check-label" for="user-remember">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-success w-md waves-effect waves-light"
                                                type="submit">User Log In</button>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your
                                                password?</a>
                                        </div>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p>Don't have an account ? <a href="{{ route('user.register') }}"
                                                class="fw-medium text-primary"> Signup now </a> </p>
                                    </div>
                                </form>

                                <!-- Admin Login Form -->
                                <form method="POST" action="{{ route('admin.login') }}" id="admin-login-form"
                                    style="display: none;">
                                    @csrf
                                    <input type="hidden" name="login_type" value="admin">
                                    <div class="mb-3">
                                        <label class="form-label" for="admin-email">Email</label>
                                        <input type="email" name="email"
                                            value="{{ old('login_type') === 'admin' ? old('email') : '' }}"
                                            class="form-control @error('email') is-invalid @enderror" id="admin-email"
                                            placeholder="Enter admin email" required>
                                        @if (old('login_type') === 'admin')
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="admin-password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="admin-password" placeholder="Enter password"
                                            required>
                                        @if (old('login_type') === 'admin')
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input"
                                                    id="admin-remember">
                                                <label class="form-check-label" for="admin-remember">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-danger w-md waves-effect waves-light"
                                                type="submit">Admin Log In</button>
                                        </div>
                                    </div>

                                    <div class="mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your
                                                password?</a>
                                        </div>
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
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        function setLoginType(type) {
            const userForm = document.getElementById('user-login-form');
            const adminForm = document.getElementById('admin-login-form');
            const userBtn = document.getElementById('user-login-btn');
            const adminBtn = document.getElementById('admin-login-btn');
            const loginHeader = document.getElementById('login-header');
            const loginTitle = document.getElementById('login-title');
            const loginSubtitle = document.getElementById('login-subtitle');

            if (type === 'user') {
                // Show user form, hide admin form
                userForm.style.display = 'block';
                adminForm.style.display = 'none';

                // Update button styles
                userBtn.classList.add('active', 'user-active');
                adminBtn.classList.remove('active', 'admin-active');

                // Update header
                loginHeader.className = 'bg-success';
                loginTitle.textContent = 'User Login';
                loginSubtitle.textContent = 'Sign in as User to continue.';
                loginTitle.className = 'text-white font-size-20';

            } else {
                // Show admin form, hide user form
                userForm.style.display = 'none';
                adminForm.style.display = 'block';

                // Update button styles
                adminBtn.classList.add('active', 'admin-active');
                userBtn.classList.remove('active', 'user-active');

                // Update header
                loginHeader.className = 'bg-danger';
                loginTitle.textContent = 'Admin Login';
                loginSubtitle.textContent = 'Sign in as Admin to continue.';
                loginTitle.className = 'text-white font-size-20';
            }
        }

        // Keep selected tab after validation/auth error, then URL param fallback
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const oldLoginType = @json(old('login_type'));
        if (oldLoginType === 'admin') {
            setLoginType('admin');
        } else if (oldLoginType === 'user') {
            setLoginType('user');
        } else if (type === 'admin') {
            setLoginType('admin');
        } else {
            setLoginType('user'); // Default to user
        }

        // Add form validation
        document.getElementById('user-login-form').addEventListener('submit', function(e) {
            const email = document.getElementById('user-email').value;
            const password = document.getElementById('user-password').value;

            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });

        document.getElementById('admin-login-form').addEventListener('submit', function(e) {
            const email = document.getElementById('admin-email').value;
            const password = document.getElementById('admin-password').value;

            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });
    </script>
</body>

</html>
