<?php

require 'includes/url.php';

session_start();

// $_SESSION['is_logged_in'] = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ($_POST['username'] == 'author' && $_POST['password'] == 'Welcome1'){

    // GENEROWANIE ŚWIEŻEJ SESJI (ID)
    // ZABEZPIECZENIE PRZEZ XSS
    session_regenerate_id(true);

    $_SESSION['is_logged_in'] = true;

    redirect('/Articles/Index.php');

  }
  else {

    $error = "Password incorrect or username does not exist";

  }
}

 ?>

<?php require 'includes/header.php' ?>

<h3><a href="Index.php">Main page</a></h3>

<!-- LOGOWANIE -->

<h2>Log in</h2>

<!-- WIADOMOŚĆ NA WYPADEK BŁĘDNEGO LOGOWANIA -->

<?php if (! empty($error)) : ?>
  <p> <?=$error?></p>
<?php endif; ?>

<!-- RAMKA I FORMULARZ -->

<fieldset>
  <legend>Enter your credentials</legend>
  <form method="post">
    <div>
      <label for="username">Username</label>
      <input name="username" id="username">
    </div>
    <br>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password">
    </div>
    <br>
    <button>Log in</button>
  </form>
</fieldset>


<?php require 'includes/header.php' ?>
