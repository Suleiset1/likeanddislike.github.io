<?php
session_start();

if (!isset($_SESSION['liked_names'])) {
    $_SESSION['liked_names'] = [];
}

if (!isset($_SESSION['disliked_names'])) {
    $_SESSION['disliked_names'] = [];
}

$names = ["Şule","Yıldız","Medine","Melek","Yağız","Batuhan","Duygu","Çiğdem","Kerem","Kadir","Ceren","Ali", "Ayşe", "Mehmet", "Fatma", "Ahmet", "Elif", "Mert", "Selin"];
$random_name = $names[array_rand($names)];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['like'])) {
        $_SESSION['liked_names'][] = $_POST['name'];
    } elseif (isset($_POST['dislike'])) {
        $_SESSION['disliked_names'][] = $_POST['name'];
    }

    header("Location: http://localhost:8080/like.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İsim Beğenme Uygulaması</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 1.2em;
            text-align: center;
        }
        form {
            text-align: center;
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[name="like"] {
            background-color: #4CAF50;
            color: #fff;
        }
        button[name="dislike"] {
            background-color: #f44336;
            color: #fff;
        }
        button:hover {
            opacity: 0.8;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .section-title {
            font-size: 1.5em;
            color: #555;
            margin-top: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>İsim Beğenme Uygulaması</h1>
        <p>Bu ismi beğendiniz mi?: <strong><?php echo htmlspecialchars($random_name); ?></strong></p>
        <form method="post" action="">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($random_name); ?>">
            <button type="submit" name="like">Beğen</button>
            <button type="submit" name="dislike">Beğenme</button>
        </form>
        <div class="section">
            <h2 class="section-title">Beğenilen İsimler</h2>
            <ul>
                <?php foreach ($_SESSION['liked_names'] as $name): ?>
                    <li><?php echo htmlspecialchars($name); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="section">
            <h2 class="section-title">Beğenilmeyen İsimler</h2>
            <ul>
                <?php foreach ($_SESSION['disliked_names'] as $name): ?>
                    <li><?php echo htmlspecialchars($name); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>