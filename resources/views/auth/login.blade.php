<x-guest-layout>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/bg-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #0069d9, #00bfff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .login-card h2 {
            text-align: center;
            color: #0069d9;
            margin-bottom: 25px;
            font-weight: 500;
        }
        .form-floating > .bi {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }
        #loginMessage {
            text-align: center;
            margin-top: 10px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #004c99;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-card">
        <h2>Hospital Login</h2>
        <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mt-2 text-center" role="alert">{{ session('success') }}</div>
            @endif

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="email" placeholder="Username or Email" :value="old('email')" required>
                <label for="username">Username or Email</label>
            </div>

            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
                <i class="bi bi-eye-fill" id="togglePassword"></i>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">
                    Remember Me
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="text-end mt-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Forgot Password?</a>
                @endif
            </div>

            <p id="loginMessage"></p>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('bi-eye-slash-fill');
        });

        // Form validation (optional, since Laravel handles it)
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Let Laravel handle validation
        });
    </script>
</x-guest-layout>
