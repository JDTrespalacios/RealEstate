<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';


// Connect to DB
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);
