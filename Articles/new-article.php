<?php

require 'includes/db_connection.php';
require 'includes/article-functions.php';
require 'includes/url.php';
require 'includes/auth.php';

session_start();

$title = '';
$content = '';
$published_at = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    $errors = validateArticle($title, $content, $published_at);


    if (empty($errors)){


    $conn = getDBconn();


    // $sql = "INSERT INTO article (title, content, published_at)
    //         VALUES ('" . mysqli_escape_string($conn, $_POST['title']) . "','"
    //                    . mysqli_escape_string($conn, $_POST['content']) . "','"
    //                    . mysqli_escape_string($conn, $_POST['published_at']) ."')";

    $sql = "INSERT INTO article (title, content, published_at)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false ){

      echo mysqli_error($conn);

      }
    else {
      mysqli_stmt_bind_param($stmt, "sss",
        $title,
        $content,
        $published_at);

      if(mysqli_stmt_execute($stmt)) {

        $id = mysqli_insert_id($conn);

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

<?php if (isLoggedIn()): ?>
  <h2>New article</h2>
  <?php require 'includes/article-form.php'; ?>
<?php else: ?>
  <a href="/Articles/login.php">Log in </a> to access author panel <br>
<?php endif; ?>

<?php require 'includes/footer.php' ?>
