<?php
require_once 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM tasks WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['title'])  &&
    isset($_POST['description'])  &&
    isset($_POST['due_date'])  &&
    isset($_POST['completed']) ) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $due_date = $_POST['due_date'];
  $completed = $_POST['completed'];

  $sql = 'UPDATE tasks SET 
    title=:title, 
    description=:description, 
    due_date=:due_date, 
    completed=:completed 
    WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title, ':description' => $description, ':due_date' => $due_date, ':completed' => $completed, ':id' => $id])) {
    header("location: ../index.php");
  }
}


 ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<!doctype html>
<html lang="en">
  <head>
    <title>CRUD</title>
    <!-- Required meta tags --tttttttttttttttt
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../index.php">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create-task.php">Create a task</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../users/create-user.php">Create a user</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <!-- Table: Title -->
          <label for="title">Title</label>
          <input value="<?= $person->title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
          <!-- Table: Description -->
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" value="<?= $person->description; ?>" name="description" id="description" class="form-control">
        </div>
          <!-- Table: Due Date -->
        <div class="form-group">
          <label for="due_date">Due Date</label>
          <input type="date" value="<?= $person->due_date; ?>" name="due_date" id="due_date" class="form-control">
        </div>
          <!-- Table: Completed -->
        <div class="form-group">
        <label class="form-label">Completed</label>
            <select  class="form-control" name="completed">
                <option value="1" <?=$person->completed == 1 ? 'selected' : ''?>>Yes</option>
                <option value="0" <?=$person->completed == 0 ? 'selected' : ''?>>No</option>
            </select>
          </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
        </div>
      </form>
    </div>
  </div>
</div>

