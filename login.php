<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "header.php";
    include "navbar.php";  
    include "db=connection.php";
    ?>
    <title>Login | Bossku Tour & Travel</title>
</head>
<body class="login-bg">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card shadow-lg p-4 rounded">
            <h2 class="text-center fw-bold mb-4">Welcome Back!</h2>
            
            <!-- Form Login -->
            <form action="process_login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <a href="forgot_password.php" class="text-decoration-none">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
<?php
include "footer.php";
?>
</html>

<style>
    /* Background Gradient */
.login-bg {
    background: linear-gradient(to right, #02335B, #005792);
}

/* Card Login */
.login-card {
    background: white;
    max-width: 400px;
    width: 100%;
    padding: 25px;
    border-radius: 10px;
}

/* Input Field Styling */
.input-group-text {
    background-color: #FFCA10;
    border: none;
    color: #02335B;
}

.form-control:focus {
    border-color: #FFCA10;
    box-shadow: 0 0 5px rgba(255, 202, 16, 0.7);
}

/* Button Styling */
.btn-primary {
    background-color: #FFCA10;
    border: none;
    color: #02335B;
    font-weight: bold;
    transition: all 0.3s;
}

.btn-primary:hover {
    background-color: #e0af0b;
}

/* Responsive */
@media (max-width: 768px) {
    .login-card {
        width: 90%;
    }
}

</style>