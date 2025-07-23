<?php
require_once 'config.php';
session_start();

// Fetch categories from database
$categories = [];
try {
    $stmt = $pdo->query("SELECT DISTINCT category FROM posts");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    // Handle error
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Komorebi</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .category-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(89, 56, 44, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            border: 1px solid rgba(231, 151, 150, 0.2);
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(89, 56, 44, 0.15);
            border-color: #FFB6C1;
        }
        
        .category-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #E79796;
        }
        
        .category-title {
            color: #59382C;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .category-count {
            color: #E79796;
            font-size: 0.9rem;
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
        <h1>Discussion Categories</h1>
        <p>Browse stories by category to find topics that interest you.</p>
        
        <div class="categories-grid">
            <?php foreach($categories as $category): ?>
                <a href="index.php?category=<?= urlencode($category) ?>" class="category-card">
                    <div class="category-icon">
                        <?php 
                            // Simple icon mapping based on category
                            $icons = [
                                'everyday life' => '🏠',
                                'garbage sorting' => '🗑️',
                                'cultural different' => '🎎',
                                'hospital related' => '🏥',
                                'others' => '💬'
                            ];
                            echo $icons[$category] ?? '📝';
                        ?>
                    </div>
                    <h3 class="category-title"><?= ucwords($category) ?></h3>
                    <p class="category-count">Explore stories</p>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Sakura Board. Connecting lives under the cherry blossoms.</p>
        </div>
    </footer>
</body>
</html>