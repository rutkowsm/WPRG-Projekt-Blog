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
    <button>Save</button>
  </fieldset>
</form>
