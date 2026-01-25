<?php


session_start();
require_once __DIR__ . '/../database/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // récupère l'utilisateur correspondant au username
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :u LIMIT 1");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    // comme le mot de passe est en clair, on compare directement
    if ($user && $password === $user['password_hash']) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: messages.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylelogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
</head>
<body>
    <h1>Connexion admin</h1>
<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
    <form method="POST">
        <label>Nom d'utilisateur:<br>
            <input type="text" name="username" required>
        </label><br><br>
        <label>Mot de passe:<br>
            <input type="password" name="password" required>
        </label><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>