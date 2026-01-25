<?php
session_start();
require_once __DIR__ . '/../database/db.php';

// Protection admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Suppression d'un message
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header('Location: messages.php?deleted=1');
    exit;
}

// Récupération des messages
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylemessage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages</title>
</head>
<body>
<h1>Messages reçus</h1>
<p>
    Connecté en tant que <?= htmlspecialchars($_SESSION['admin_username']) ?>
    | <a href="logout.php">Se déconnecter</a>
</p>

<?php if (isset($_GET['deleted'])): ?>
    <p style="color:lime;">Message supprimé.</p>
<?php endif; ?>

<?php if (empty($messages)): ?>
    <p>Aucun message pour le moment.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?= (int)$msg['id'] ?></td>
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td><?= htmlspecialchars($msg['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                <td><?= htmlspecialchars($msg['created_at']) ?></td>
                <td>
                    <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re%3A%20Votre%20message">Répondre</a>
                    |
                    <a href="messages.php?delete=<?= (int)$msg['id'] ?>"
                       onclick="return confirm('Supprimer ce message ?');">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
