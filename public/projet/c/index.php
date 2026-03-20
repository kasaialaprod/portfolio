<?php
require_once __DIR__ . '/../../../database/db.php';

$currentTech = 'c';

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
    <title>Projets C - Portfolio d'Israël</title>
</head>
<body>
    <header>
        <h2>Projets C</h2>
        <p>Voici tout les projets que j'ai eu l'occasion de réaliser en C dans le cadre de ma formation ou en tant que projet personnel ;).</p>
    </header>
    <main>
        <div class="cards-wrapper" id="cardsWrapper">

            <?php if (empty($projects)): ?>
                <p>Aucun projet C pour le moment.</p>
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
