<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Komorebi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Registration page specific styles */
        .register-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 10;
        }
        
        .register-container h2 {
            color: var(--pink2);
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
            color: var(--brown);
            font-weight: 500;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s;
            background-color: var(--cream);
        }
        
        .form-group input:focus, 
        .form-group select:focus {
            border-color: var(--pink1);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255,182,193,0.3);
        }
        
        .register-btn {
            background: var(--pink1);
            color: white;
            border: none;
            padding: 1rem;
            width: 100%;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
            font-weight: bold;
        }
        
        .register-btn:hover {
            background: var(--pink2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--brown);
        }
        
        .login-link a {
            color: var(--pink2);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            color: var(--pink1);
            text-decoration: underline;
        }
        
        .terms {
            margin-top: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .terms input[type="checkbox"] {
            width: auto;
        }
        
        .terms label {
            margin-bottom: 0;
            color: var(--brown);
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
        
        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background-color: #eee;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
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
    <header>
        <h1>Komorebi</h1>
        <p>Sunlight through leaves - Share your Japan experience</p>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="login.html">Login</a>
        <a href="register.html" class="active">Register</a>
    </nav>

    <main>
        <div class="register-container">
            <h2>Create Your Account</h2>
            
            <!-- Error/Success Messages -->
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php 
                        if ($_GET['error'] === 'email_exists') {
                            echo "✗ This email is already registered. Please login or use a different email.";
                        } elseif ($_GET['error'] === 'database_error') {
                            echo "✗ Database error occurred. Please try again later.";
                        } elseif ($_GET['error'] === 'password_mismatch') {
                            echo "✗ Passwords do not match. Please try again.";
                        } elseif ($_GET['error'] === 'terms_not_accepted') {
                            echo "✗ You must accept the terms and conditions to register.";
                        }
                    ?>
                </div>
            <?php elseif (isset($_GET['success'])): ?>
                <div class="success-message">
                    ✓ Registration successful! You can now <a href="login.html">login</a>.
                </div>
            <?php endif; ?>

            <form id="registerForm" action="php/register.php" method="POST" onsubmit="return validateForm()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required 
                               placeholder="e.g. Sakura" autocomplete="given-name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required 
                               placeholder="e.g. Tanaka" autocomplete="family-name">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="your.email@example.com" autocomplete="email">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required 
                               placeholder="At least 8 characters" minlength="8"
                               oninput="checkPasswordStrength(this.value)">
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required 
                               placeholder="Re-enter your password">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="location">Location in Japan</label>
                    <select id="location" name="location" autocomplete="country-name">
                        <option value="">Select your location...</option>
                        <option value="Tokyo">Tokyo</option>
                        <option value="Osaka">Osaka</option>
                        <option value="Kyoto">Kyoto</option>
                        <option value="Hokkaido">Hokkaido</option>
                        <option value="Okinawa">Okinawa</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="#" style="color: var(--pink2);">Terms and Conditions</a></label>
                </div>
                
                <button type="submit" class="register-btn">Create Account</button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="login.html">Login here</a></p>
            </div>
        </div>
    </main>

    <script src="js/main.js"></script>
    <script>
        // Password strength indicator
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Character variety checks
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Update strength bar
            const width = (strength / 5) * 100;
            strengthBar.style.width = width + '%';
            
            // Update color
            if (strength <= 2) {
                strengthBar.style.backgroundColor = '#ff5252'; // Weak (red)
            } else if (strength <= 4) {
                strengthBar.style.backgroundColor = '#ffab40'; // Medium (orange)
            } else {
                strengthBar.style.backgroundColor = '#4caf50'; // Strong (green)
            }
        }
        
        // Form validation
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const termsChecked = document.getElementById('terms').checked;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                document.getElementById('confirm_password').focus();
                return false;
            }
            
            if (!termsChecked) {
                alert('You must accept the terms and conditions to register.');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>