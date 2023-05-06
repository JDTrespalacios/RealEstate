<?php 


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');


function incluirTemplate(string $nombre, $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}


function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']){  
        header('Location: /');
    }
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Sanitize HTML
function s($html): string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: 
            $mensaje = 'Created Successfully';
            break;
        case 2: 
            $mensaje = 'Updated Successfully';
            break;
        case 3:
            $mensaje = 'Deleted Successfully';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}