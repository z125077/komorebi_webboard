<?php
require_once 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komorebi</title>
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
                <h1>🌸Komorebi
                </h1>
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
        <div class="hero">
            <h2>Share Your Journey in Japan</h2>
            <p>A place where expats and locals share their daily experiences, challenges, and discoveries in the Land of the Rising Sun.</p>
        </div>

        <div class="filter-bar">
            <button class="filter-btn active" data-category="all">All Stories</button>
            <button class="filter-btn" data-category="everyday life">Everyday Life</button>
            <button class="filter-btn" data-category="garbage sorting">Garbage Sorting</button>
            <button class="filter-btn" data-category="cultural different">Cultural Differences</button>
            <button class="filter-btn" data-category="hospital related">Hospital Related</button>
            <button class="filter-btn" data-category="others">Others</button>
        </div>

        <div class="posts-container" id="postsContainer">
            <!-- Posts will be loaded here via JavaScript -->
        </div>

        <div class="load-more">
            <button class="load-more-btn" id="loadMoreBtn">Load More Stories</button>
        </div>
    </main>

    <div class="post-modal" id="postModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div class="modal-body" id="modalBody">
                <!-- Post details will be loaded here -->
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Komorebi. Sharing stories under the dappled sunlight.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>