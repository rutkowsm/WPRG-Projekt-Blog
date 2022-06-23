
<?php
require 'includes/db_connection.php';
require 'includes/article-functions.php';
require 'includes/url.php';

session_start();

$conn = getDBconn();

if (isset($_GET['id'])) {

  $article = getArticle($conn, $_GET['id']);

  if ($article) {

    $id = $article['id'];
    $title = $article['title'];
    $content = $article['content'];
    $published_at = $article['published_at'];
  }

  else {
    die("article not found!");
  }



  }
else {
  die("id not supplied, article not found!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $title = $_POST['title'];
  $content = $_POST['content'];
  $published_at = $_POST['published_at'];

  $errors = validateArticle($title, $content, $published_at);


  if (empty($errors)){

    // $sql = "INSERT INTO article (title, content, published_at)
    //         VALUES ('" . mysqli_escape_string($conn, $_POST['title']) . "','"
    //                    . mysqli_escape_string($conn, $_POST['content']) . "','"
    //                    . mysqli_escape_string($conn, $_POST['published_at']) ."')";

    $sql = "UPDATE article
            set title = ?,
                content = ?,
                published_at = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false ){

      echo mysqli_error($conn);

      }
    else {
      mysqli_stmt_bind_param($stmt, "sssi",
        $title,
        $content,
        $published_at,
        $id);

      if(mysqli_stmt_execute($stmt)) {

        redirect("/Articles/article.php?id=$id");

        }
      else {
        echo mysqli_stmt_error($stmt);
        }
      }
  }
}
?>

<?php require 'includes/header.php' ?>

<h3><a href="Index.php">Main page</a></h3>

<!-- SPRAWDZANIE CZY UŻYTKOWNIK JEST ZALOGOWANY  -->

<?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']): ?>
  <h2>Edit article</h2>
  <?php require 'includes/article-form.php'; ?>
<?php else: ?>
  <a href="/Articles/login.php">Log in </a> to access author panel <br>
<?php endif; ?>

<?php require 'includes/footer.php' ?>
