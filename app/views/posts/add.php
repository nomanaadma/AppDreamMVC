<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <?php
      if (isset($data['errors'])) {
        foreach ($data['errors'] as $key => $errors) {
          foreach ($errors as $error) {
            echo '<div class="alert alert-danger"><strong>' . ucfirst($key) . ':</strong> '. $error .'</div>';
          }
        }
      }
    ?>
    <form action="<?php echo URLROOT; ?>/posts/add" method="post">
      <div class="form-group">
        <label for="title">Title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg" value="<?php echo $data['title']; ?>">
      </div>
      <div class="form-group">
        <label for="body">Body: <sup>*</sup></label>
        <textarea name="body" class="form-control form-control-lg"><?php echo $data['body']; ?></textarea>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>