<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


    require '../../includes/app.php';

    estaAutenticado();

    // Validate URL by ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    // Get property data
    $propiedad = Propiedad::find($id);

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    // Array wtih error messages
    $errores = Propiedad::getErrores();

    // Run after a user sends the form
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        // VALIDATION
        $errores = $propiedad->validar();
        
        // UPLOAD FILES
        // Generate a unique name   
        $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){
                // Almacenar imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Update Property</h1>

        <a href="/admin" class="boton boton-verde">Back</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Update Property" class="boton boton-verde" >
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>