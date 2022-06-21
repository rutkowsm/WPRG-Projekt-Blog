<?php

require 'includes/db_connection.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    if ($title == '') {
      $errors[] = 'Title is required!';
    }

    if ($content == '') {
      $errors[] = 'Content is required!';
    }

    if ($published_at == '') {
      $errors[] = 'Date of publication is required!';
    }

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
        echo "Article with id: $id successfully inserted";
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

<h2>New article</h2>
<?php if (! empty($errors)): ?>
  <ul>
      <?php foreach ($errors as $error): ?>
        <li> <?=$error ?></li>
      <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post">
  <fieldset>
    <legend>Article section</legend>
    <div>
        <label for="title">Title: </label>
        <br>
        <input id="title" name="title" placeholder="enter title here..." value="<?= htmlspecialchars($title); ?>">
    </div>
    <br>
    <div>
        <label for="content">Content: </label>
        <br>
        <textarea id="content" name="content" rows="14" cols="80" placeholder="Start typing..."><?= htmlspecialchars($content); ?></textarea>
    </div>
    <br>
    <div>
      <label> Publication date and time: <input type="datetime-local" name="published_at" value="<?= htmlspecialchars($content); ?>"> </label>
    </div>
    <!-- <fieldset>
      <legend>Schedule</legend>
      <div>
        <label>Date of publication: <input type="date" name="date"></label>
      </div>
      <br>
      <div>
        <label> Time of publication: <input type="time" name="time" value="00:00"> </label>
      </div>
    </fieldset> -->
    <br>
    <button>Add</button>
  </fieldset>
</form>

<?php require 'includes/footer.php' ?>
