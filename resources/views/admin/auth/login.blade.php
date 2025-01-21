<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Website Kantin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

</head>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        overflow: hidden;
        font-family: 'Source Sans Pro', sans-serif;
    }

    /* Background Gradient Styling */
    .background-gradient {
        position: fixed;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1e3c72, #2a5298, #6a89cc, #acc7d5, #ffffff);
        background-size: 300% 300%;
        animation: gradientAnimation 12s linear infinite;
    }

    /* Keyframes for Gradient Animation */
    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }

        25% {
            background-position: 50% 100%;
        }

        50% {
            background-position: 100% 50%;
        }

        75% {
            background-position: 50% 0%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .login-box {
        margin-right: 80px;
        position: relative;
        width: 400px;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }

    /* Form Input Styling */
    .form-control {
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #1e3c72;
        border-color: #1e3c72;
    }
</style>


<body class="login-page">

    <div class="background-gradient"></div>

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h2"><b>Website Kantin</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login!</p>

                @if (session()->has('loginError'))
                    <div class="alert alert-danger">
                        {{ session('loginError') }}
                    </div>
                @endif
                <form action="/login/do" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Email">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password"
                            class="form-control @error('password') is-invalid @enderror border-right-0" name="password"
                            placeholder="Password" id="password-input">
                        <div class="input-group-append">
                            <!-- Ikon mata untuk toggle show/hide password -->
                            <span class="input-group-text bg-white border-left-0" id="toggle-password"
                                style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->


    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>

    <script>
        // JavaScript untuk toggle show/hide password
        const togglePassword = document.querySelector("#toggle-password");
        const passwordInput = document.querySelector("#password-input");

        togglePassword.addEventListener("click", function() {
            // Toggle antara tipe password dan teks
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;

            // Toggle ikon mata
            this.querySelector("i").classList.toggle("fa-eye-slash");
        });
    </script>

</body>

</html>
