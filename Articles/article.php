
<?php
require 'includes/db_connection.php';
require 'includes/article-functions.php';

session_start();

$conn = getDBconn();

if (isset($_GET['id'])) {

  $article = getArticle($conn, $_GET['id']);

  }
  else {
    $article = null;
}

 ?>
 <h3><a href="Index.php">Main page</a></h3>
 <?php require 'includes/header.php' ?>
      <?php if ($article === null): ?>
        <p>No articles found</p>
      <?php else: ?>

            <article class="articles">
              <h2><?= htmlspecialchars($article['title']) ?></h2>
              <p><?= $article['published_at']; ?></p>
              <p><?= htmlspecialchars($article['content']); ?></p>
            </article>
            <br>
            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
              <a href="edit-article.php?id=<?= $article['id']; ?>">Edit article</a>
                <!-- PRÓBOWAŁEM UMIEŚCIĆ BUTTON, ALE NIE MOGĘ ZMUSIĆ GO ŻEBY POBRAŁ ID -->
              <!-- <form action="edit-article.php?id=<?= $article['id']; ?>" method="get">
                <button>Edit article</button>
              </form> -->
              <br><br>
              <!-- <form  action="delete-article.php?id=<?= $article['id']; ?>" method="post">
                <button>Delete article</button>
              </form> -->
              <!-- TO DZIAŁA ALE CHCIAŁEM, ŻEBY BYŁO SPÓJNIE -->
              <a href="delete-article.php?id=<?= $article['id']; ?>">Delete article</a>
            <?php endif; ?>
    <?php endif; ?>
 <?php require 'includes/footer.php' ?>
