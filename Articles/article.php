
<?php
require 'includes/db_connection.php';
require 'includes/article-functions.php';

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
            <!-- <form action="edit-article.php?id=<?= $article['id']; ?>">
              <input type="submit" value="Edit article">
            </form> -->
            <a href="edit-article.php?id=<?= $article['id']; ?>">Edit article</a>

    <?php endif; ?>
 <?php require 'includes/footer.php' ?>
