<?php
require_once 'config.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category = $_POST['category'] ?? 'others';
    $author_id = $_SESSION['user_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, author_id, category, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $content, $author_id, $category]);
        
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $error = "Error creating post: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - Sakura Board</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Add your existing styles here */
        .create-post-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(89, 56, 44, 0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #59382C;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #E79796;
            border-radius: 8px;
            font-family: 'Noto Sans JP', sans-serif;
        }
        
        .form-group textarea {
            min-height: 200px;
            resize: vertical;
        }
        
        .submit-btn {
            background: #E79796;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            background: #FFB6C1;
            transform: translateY(-2px);
        }
        
        .error {
            color: #FF6B6B;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
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
                <a href="logout.php" class="nav-link">Logout</a>
            </nav>
        </div>
    </header>

    <div class="create-post-container">
        <h1>Create New Post</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="everyday life">Everyday Life</option>
                    <option value="garbage sorting">Garbage Sorting</option>
                    <option value="cultural different">Cultural Differences</option>
                    <option value="hospital related">Hospital Related</option>
                    <option value="others" selected>Others</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Create Post</button>
        </form>
    </div>
</body>
</html>