<?php
/**
 * Get the article record by its Id
 *
 * @param object $conn Connection to the DB
 * @param integer $id the article Id
 *
 * @return mixed An associative array containing the article with that Id or null if not found
*/

  function getArticle($conn, $id){

    $sql = "SELECT *
            FROM article
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
      echo mysqli_error($conn);
    }

    else {

      mysqli_stmt_bind_param($stmt, "i", $id);

      if (mysqli_stmt_execute($stmt)) {

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_array($result, MYSQLI_ASSOC);
      }
    }
  }

/**
 *
 * @param string $title Title of the article, required
 * @param string $content Content of the article, required
 * @param timestamp $published_at - date and time when the article is released
 *
 * @return array Array of validation error messages
 *
*/

  function validateArticle($title, $content, $published_at){
    $errors =[];

    if ($title == '') {
      $errors[] = 'Title is required!';
    }

    if ($content == '') {
      $errors[] = 'Content is required!';
    }

    if ($published_at == '') {
      $errors[] = 'Date of publication is required!';
    }
    return $errors;
  }

 ?>
