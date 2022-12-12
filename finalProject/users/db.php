<?php
$dsn = 'mysql:host=localhost;dbname=to-do-list';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}