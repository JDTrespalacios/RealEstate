<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Root123', 'realestate_crud');

    if (!$db){
        echo 'Error. Could not connect';
        exit;
    }

    return $db;
} 