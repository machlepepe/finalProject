<?php
require_once 'db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM tasks WHERE id=:id';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: ../index.php");
}