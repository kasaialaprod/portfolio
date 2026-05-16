<?php
/*session_start();
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
$messages = $stmt->fetchAll();*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Back office – Technologies</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="topbar">
    <h1>Back office – Technologies & Messages</h1>
    <a href="logout.php"><button id="logout-btn">Déconnexion</button></a>
  </header>

  <main class="tech-layout">
    <section class="tech-section">
      <h2 class="tech-title">Choisis une technologie</h2>
      <p class="tech-subtitle">
        Sélectionne un langage ou un outil pour gérer les projets associés.
      </p>

      <div class="tech-grid">
        <!-- Front -->
        <a href="projet/html-css/index.php"><article class="tech-card" data-tech="html-css">
          <h3>Développement Front End</h3>
          <p>HTML/CSS</p>
        </article></a>

        <a href="projet/js/index.php"><article class="tech-card" data-tech="javascript">
          <h3>Développement Front End</h3>
          <p>JavaScript</p>
        </article></a>

        <a href="projet/react/index.php"><article class="tech-card" data-tech="react">
          <h3>Développement Front End</h3>
          <p>React</p>
        </article></a>

        <a href="projet/swift/index.php"><article class="tech-card" data-tech="swiftui">
          <h3>Développement Front End</h3>
          <p>SwiftUI</p>
        </article></a>

        <a href="projet/angular/index.php"><article class="tech-card" data-tech="microsoft365">
          <h3>Développement Front End</h3>
          <p>Angular</p>
        </article></a>

        <a href="projet/dotnet/index.php"><article class="tech-card" data-tech="microsoft365">
          <h3>Développement Front End</h3>
          <p>.Net</p>
        </article></a>

        <!-- Back -->
        <a href="projet/node/index.php"><article class="tech-card" data-tech="nodejs">
          <h3>Développement Back End</h3>
          <p>Node.js</p>
        </article></a>

        <a href="projet/php/index.php"><article class="tech-card" data-tech="php">
          <h3>Développement Back End</h3>
          <p>PHP</p>
        </article></a>

        <a href="projet/python/index.php"><article class="tech-card" data-tech="python">
          <h3>Développement Back End</h3>
          <p>Python</p>
        </article></a>

        <!-- Système -->
        <a href="projet/c/index.php"><article class="tech-card" data-tech="c">
          <h3>Développement Système</h3>
          <p>C</p>
        </article></a>

        <a href="projet/c++/index.php"><article class="tech-card" data-tech="cpp">
          <h3>Développement Système</h3>
          <p>C++</p>
        </article></a>
      </div>
    </section>

    <section class="upload-section">
      <h2 class="upload-title">Lien et document</h2>
      <p class="upload-subtitle">
        Ajoute/Modifie des liens ou télécharge des documents (cv, github etc).
      </p>
      <form action="/routes/upload_doc.php" method="post" enctype="multipart/form-data">
        <input type="file" name="cv_file" accept="application/pdf" required />
        <button type="submit">Télécharger nouveau CV</button>
      </form>
      <?php
      $filePath = __DIR__ . '/../database/links.json';

      $links = [];
      if (file_exists($filePath)) {
          $links = json_decode(file_get_contents($filePath), true);
          if (!is_array($links)) {
              $links = [];
          }
      }
      ?>

      <div class="links-list">
          <?php foreach ($links as $link): ?>
              <div class="link-card" data-id="<?php echo htmlspecialchars($link['id']); ?>">
                  <h3><?php echo htmlspecialchars($link['title']); ?></h3>
                  <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" rel="noopener noreferrer">
                      <?php echo htmlspecialchars($link['url']); ?>
                  </a>
                  <button type="button" class="btn-delete-link">Supprimer</button>
              </div>
          <?php endforeach; ?>
      </div>
      <div class="new-link" id="new-link" >+ Ajouter un lien</div>
      
    </section>

    <section class="message-section">
      <h2 class="message-title">Messages reçus</h2>
      <p class="message-subtitle">
        Consulte les messages envoyés via le formulaire de contact.
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
                                <a href="backoffice.php?delete=<?= (int)$msg['id'] ?>"
                                onclick="return confirm('Supprimer ce message ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
    </section>
  </main>
  <script src="app.js"></script>
</body>
</html>
