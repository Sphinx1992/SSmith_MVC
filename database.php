<?php
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'root';
    $password = 'Godzilla@1992';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
