<?php
session_start();
require_once __DIR__ . '/../../../database/db.php';

//Protection admin
//if (!isset($_SESSION['admin_id'])) {
//    header('Location: login.php');
//    exit;
//}

// Techno courante
$currentTech = 'c++';

// Insertion d’un nouveau projet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $short = trim($_POST['short_description'] ?? '');
    $url   = trim($_POST['url'] ?? '');

    if ($title !== '') {
        $stmt = $pdo->prepare("
            INSERT INTO projects (tech, title, short_description, url)
            VALUES (:tech, :title, :short, :url)
        ");
        $stmt->execute([
            ':tech'  => $currentTech,
            ':title' => $title,
            ':short' => $short,
            ':url'   => $url !== '' ? $url : null,
        ]);
        header('Location: admin-projects-c++.php?added=1');
        exit;
    }
}

// Récupération des projets C++
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
    <title>Projets C++ - Portfolio d'Israël</title>
</head>
<body>
<header>
    <h2>Projets C++</h2>
    <p>Personne va voir faut pas faire semblant mdr</p>
</header>

<main>
    <?php if (isset($_GET['added'])): ?>
        <p class="alert-success">Projet ajouté.</p>
    <?php endif; ?>

    <div class="cards-wrapper" id="cardsWrapper">
        <?php if (empty($projects)): ?>
            <p>Aucun projet C++ pour le moment.</p>
        <?php else: ?>
            <?php foreach ($projects as $project): ?>
                <article class="card" data-id="<?= (int)$project['id'] ?>">
                    <div class="card-header">
                        <h3><?= htmlspecialchars($project['title']) ?></h3>

                        <button
                            class="btn-delete"
                            type="button">
                            Supprimer
                        </button>
                    </div>

                    <?php if (!empty($project['url'])): ?>
                    <?php endif; ?>
                </article>
                
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <section class="new-project-section">
        <div class="new-projet" id="new-projet" >+ Ajouter un projet</div>
    </section>
</main>
<script src="app.js"></script>
</body>
</html>
