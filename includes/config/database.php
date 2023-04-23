<?php 

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'Root123', 'realestate_crud');

    if (!$db){
        echo 'Error. Could not connect';
        exit;
    }

    return $db;
} 