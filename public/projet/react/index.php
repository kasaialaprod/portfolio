<?php
require_once __DIR__ . '/../../../database/db.php';

$currentTech = 'react';

$stmt = $pdo->prepare("SELECT * FROM projects WHERE tech = :tech ORDER BY created_at DESC");
$stmt->execute([':tech' => $currentTech]);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Projets React - Portfolio d'Israël</title>
</head>
<body>
    <header>
        <h2>Projets React</h2>
        <p>Voici tout les projets que j'ai eu l'occasion de réaliser en React dans le cadre de mon apprentissage ;).</p>
    </header>
    <main>
        <div class="cards-wrapper" id="cardsWrapper">

            <?php if (empty($projects)): ?>
                <p>Aucun projet React pour le moment.</p>
            <?php else: ?>
                <?php foreach ($projects as $project): ?>
                    <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank">
                        <div class="card">
                            <h2><?= htmlspecialchars($project['title']) ?></h2>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>
