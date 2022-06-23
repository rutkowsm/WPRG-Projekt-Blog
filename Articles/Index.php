<!-- POŁĄCZENIE DO BAZY -->
<?php
require 'includes/db_connection.php';

// SESJA
session_start();

// FUNKCJA DEFINIUJĄCA POŁĄCZENIE
$conn = getDBconn();

$sql = "SELECT
          id,
          title,
          concat(substr(content, 1, 200), '...[read more]') as content,
          published_at
        FROM article
        order by published_at desc";

$results = mysqli_query($conn, $sql);

if ($results === false ){
  echo mysqli_error($conn);
}
else {
  $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
 ?>

 <!-- HEADER HTML -->
 <?php require 'includes/header.php' ?>

 <!-- LOGOWANIE -->
 <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
   <p>Welcome to the author panel.</p> <a href="logout.php">Log out</a>
   <br><br>
   <form action="new-article.php">
     <input type="submit" value="Add new article">
   </form>
 <?php else: ?>
   <a href="login.php">Log in</a>
 <?php endif; ?>

 <!-- LINK: DODAWANIE NOWEGO ARTYKUŁU -->
 <!-- <h3><a href="new-article.php">Add new article</a></h3> -->


<!-- WYŚWIETLANIE DOSTĘPNYCH ARTYKUŁÓW -->
 <header>
   <h1>List of articles</h1>
 </header>
      <?php if (empty($articles)): ?>
        <p>No articles found</p>
      <?php else: ?>
      <ul>
        <?php foreach ($articles as $article):?>
          <li>
            <article>
              <h2><a href="article.php?id=<?= $article['id']; ?>">
                <?= htmlspecialchars($article['title'])?></a></h2>
              <p><?= $article['published_at']; ?></p>
              <p><?= htmlspecialchars($article['content']); ?></p>
            </article>

          </li>
        <?php endforeach;  ?>
      </ul>
    <?php endif; ?>

  <!-- FOOTER -->
<?php require 'includes/footer.php' ?>
