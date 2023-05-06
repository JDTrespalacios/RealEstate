<?php 

    // Import the connection
    require 'includes/app.php';
    $db = conectarDB();

   // Create email and password
   $email = "correo@correo.com";
   $password = "123456";

   $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Query to create user
    $query = " INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}');";
    echo $query;

    // Add to DB
    mysqli_query($db, $query);



?>