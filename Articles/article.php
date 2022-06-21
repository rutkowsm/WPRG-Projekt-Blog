
<?php
require 'includes/db_connection.php';

$conn = getDBconn();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {


  $sql = "SELECT *
          FROM article
          WHERE id = " . $_GET['id'];

  $results = mysqli_query($conn, $sql);

  if ($results === false ){
    echo mysqli_error($conn);
    }
    else {
      $article = mysqli_fetch_assoc($results);
    }
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

    <?php endif; ?>
 <?php require 'includes/footer.php' ?>
