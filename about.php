<?php
require_once 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Komorebi</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
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
                <h1>🌸Komorebi</h1>
            </div>
            <nav class="nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="categories.php" class="nav-link">Categories</a>
            <a href="popular.php" class="nav-link">Popular</a>
            <a href="about.php" class="nav-link">About</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="create_post.php" class="nav-link" id="createPostLink" style="background: #FFB6C1; color: white; padding: 0.5rem 1rem; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">+</a>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link" id="loginLink">Login</a>
                <a href="register.php" class="nav-link" id="registerLink">Register</a>
            <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="main-container">
        <div class="section">
            <h1>About Sakura Board</h1>
            <p>Your gateway to connecting with the vibrant expatriate community in Japan. Share experiences, get advice, and build meaningful connections.</p>
        </div>
        
        <div class="section">
            <h2>Community Discussions</h2>
            <p>Engage in meaningful conversations about daily life, cultural experiences, and everything in between with fellow expats and locals.</p>
        </div>
        
        <div class="section">
            <h2>Cultural Exchange</h2>
            <p>Share and learn about Japanese culture through firsthand experiences and discussions.</p>
        </div>
        
        <div class="section">
            <h2>Practical Advice</h2>
            <p>Get help with hospital visits, garbage sorting, bureaucracy, and other practical aspects of living in Japan.</p>
        </div>
        
        <div class="section">
            <h2>Support Network</h2>
            <p>Find emotional support, practical help, and friendship within our welcoming community of Japan residents.</p>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Sakura Board. Connecting lives under the cherry blossoms.</p>
        </div>
    </footer>
</body>
</html>