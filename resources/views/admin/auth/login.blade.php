<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Website Kantin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/logo-color.png">


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
    /* .background-gradient {
        position: fixed;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1e3c72, #2a5298, #6a89cc, #acc7d5, #ffffff);
        background-size: 300% 300%;
        animation: gradientAnimation 12s linear infinite;
    } */

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
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h2"><b>Website Kantin</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login!</p>

                <div id="alert-message"></div>

                <form id="login-form">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control border-right-0" name="password"
                            placeholder="Password" id="password-input" required>
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-left-0" id="toggle-password"
                                style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>

    {{-- <script>
        // JavaScript untuk toggle show/hide password
        const togglePassword = document.querySelector("#toggle-password");
        const passwordInput = document.querySelector("#password-input");

        togglePassword.addEventListener("click", function() {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
            this.querySelector("i").classList.toggle("fa-eye-slash");
        });

        // Handle login form submission
        document.getElementById('login-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let response = await fetch('http://localhost:9000/api/login', {
                method: 'POST',
                body: formData
            });

            let result = await response.json();
            if (result.success) {
                localStorage.setItem('token', result.data.token);
                document.getElementById('alert-message').innerHTML =
                    '<div class="alert alert-success">Login berhasil! Mengalihkan ke dashboard...</div>';
                setTimeout(() => {
                    window.location.href = "/admin/dashboard";
                }, 1500);
            } else {
                document.getElementById('alert-message').innerHTML =
                    '<div class="alert alert-danger">Login gagal: ' + result.message + '</div>';
            }
        });
    </script> --}}

    <script>
        document.getElementById("login-form").addEventListener("submit", async function(event) {
            event.preventDefault();

            const email = document.querySelector("input[name='email']").value;
            const password = document.querySelector("input[name='password']").value;

            try {
                const response = await fetch("http://127.0.0.1:9000/api/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // ✅ Simpan token ke localStorage
                    localStorage.setItem("token", data.data.token);

                    // ✅ Redirect ke halaman dashboard
                    window.location.href = "/admin/dashboard";
                } else {
                    alert(data.message || "Login gagal, silakan coba lagi.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Terjadi kesalahan, silakan coba lagi.");
            }
        });
    </script>


    {{-- <script>
    document.getElementById("login-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Mencegah form submit langsung

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        fetch("/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Simpan token di localStorage
                localStorage.setItem("token", data.data.token);

                // Redirect ke halaman dashboard
                window.location.href = data.redirect;
            } else {
                // Tampilkan pesan error jika login gagal
                let errorMessage = document.getElementById("error-message");
                errorMessage.textContent = data.message;
                errorMessage.classList.remove("d-none"); // Tampilkan error message
            }
        })
        .catch(error => console.error("Error:", error));
    });
</script> --}}

</body>

</html>
