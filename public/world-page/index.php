<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="viewport">
    <section class="section section-hero">
      <div class="content">
        <h1>Bagage Technique</h1>
        <p>Les services et tâches que je peux réaliser et les outils que j'utilise.</p>

        <button class="cta-cards" id="showCardsBtn">
          Découvrez cela ici
        </button>
      </div>

      <div class="cards-wrapper" id="cardsWrapper">
        <article class="card">
          <h2>Développement front end</h2>
          <p>Dévoloppement d'application web statique ou interactive.</p>
        </article>

        <article class="card">
          <h2>Développement back end</h2>
          <p>Compréhension de la logique serveur, des bases de données et des API pour faire fonctionner les applications web.</p>
        </article>

        <article class="card">
          <h2>Card 3</h2>
          <p>Encore un autre élément à découvrir.</p>
        </article>
      </div>
    </section>

    <section class="section section-about">
      <div class="content">
        <h2>À propos</h2>
        <p>
          Chaque section occupe 100% de la hauteur de l’écran et se cale
          automatiquement quand tu scroll.
        </p>
      </div>
    </section>

    <section class="section section-projects">
      <div class="content">
        <h2>Projets</h2>
        <p>
          Tu peux utiliser cette structure pour un portfolio, une landing page
          ou une présentation.
        </p>
        <button class="btn-primary">Call to action</button>
      </div>
    </section>

    <section class="section section-contact">
      <div class="content">
        <h2>Contact</h2>
        <p>Dernière section avec un fond plus sombre pour le contraste.</p>
      </div>
    </section>
  </div>
  <script src="script.js"></script>
</body>
</html>