<?php
require_once 'config.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sakura Board</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Add your existing sakura animation and base styles here */
        
        /* Registration specific styles */
        .register-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(89, 56, 44, 0.1);
            position: relative;
            z-index: 10;
        }
        
        .register-container h2 {
            color: #E79796;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }
        
        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            flex: 1;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #59382C;
            font-weight: 500;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #E79796;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: rgba(255, 255, 255, 0.8);
            font-family: 'Noto Sans JP', sans-serif;
        }
        
        .form-group input:focus, 
        .form-group select:focus {
            border-color: #FFB6C1;
            outline: none;
            box-shadow: 0 0 0 3px rgba(231, 151, 150, 0.3);
        }
        
        .register-btn {
            background: #E79796;
            color: white;
            border: none;
            padding: 1rem;
            width: 100%;
            border-radius: 25px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            font-weight: 500;
        }
        
        .register-btn:hover {
            background: #FFB6C1;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 151, 150, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #59382C;
        }
        
        .login-link a {
            color: #E79796;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            color: #FFB6C1;
            text-decoration: underline;
        }
        
        .terms {
            margin-top: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #59382C;
        }
        
        .terms input[type="checkbox"] {
            width: auto;
        }
        
        .error-message {
            color: #d62c1a;
            background-color: #ffebee;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid #d62c1a;
            animation: fadeIn 0.5s;
        }
        
        .success-message {
            color: #2e7d32;
            background-color: #edf7ed;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid #2e7d32;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 35px;
            cursor: pointer;
            color: #E79796;
        }
        
        /* Responsive adjustments */
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .register-container {
                margin: 2rem 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="sakura-container">
        <div class="sakura"></div>
        <div class="sakura"></div>
        <div class="sakura"></div>
        <div class="sakura"></div>
        <div class="sakura"></div>
    </div>

    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>🌸 Sakura Board</h1>
            </div>
            <nav class="nav">
                <a href="index.php" class="nav-link">Home</a>
                <a href="login.php" class="nav-link">Login</a>
                <a href="register.php" class="nav-link active">Register</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="register-container">
            <h2>Create Your Account</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php 
                        $errors = [
                            'email_exists' => "This email is already registered. Please login or use a different email.",
                            'database_error' => "Database error occurred. Please try again later.",
                            'password_mismatch' => "Passwords do not match. Please try again.",
                            'terms_not_accepted' => "You must accept the terms and conditions to register."
                        ];
                        echo $errors[$_GET['error']] ?? "An error occurred during registration.";
                    ?>
                </div>
            <?php endif; ?>

            <form id="registerForm" action="php/register.php" method="POST">
                <div class="form-group">
                    <label for="author_name">Full Name</label>
                    <input type="text" id="author_name" name="author_name" required 
                           placeholder="e.g. Sakura Tanaka" autocomplete="name">
                </div>
                
                <div class="form-group">
                    <label for="author_email">Email Address</label>
                    <input type="email" id="author_email" name="author_email" required 
                           placeholder="your.email@example.com" autocomplete="email">
                </div>
                
                <div class="form-row">
                    <div class="form-group password-container">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required 
                               placeholder="At least 8 characters" minlength="8">
                        <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                    </div>
                    <div class="form-group password-container">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required 
                               placeholder="Re-enter your password">
                        <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
                    </div>
                </div>
                
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="terms.php" style="color: #E79796;">Terms and Conditions</a></label>
                </div>
                
                <button type="submit" class="register-btn">Create Account</button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </main>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const termsChecked = document.getElementById('terms').checked;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                e.preventDefault();
                document.getElementById('confirm_password').focus();
                return false;
            }
            
            if (!termsChecked) {
                alert('You must accept the terms and conditions to register.');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>