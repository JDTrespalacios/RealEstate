<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;


    estaAutenticado();

    $propiedad = new Propiedad;

    //Consulta para obtener todos los venededores
    $vendedores = Vendedor::all();

    // Array with error messages
    $errores = Propiedad::getErrores();

    // Run after a user sends the form
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        /** Create a new instance */
         $propiedad = new Propiedad($_POST['propiedad']);

        /** SUBIDA DE ARCHIVOS **/

        // Generate a unique name   
        $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

        // Set image 
        // Resizes image with Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        // VALIDATE
        $errores = $propiedad->validar();

        
        if (empty($errores)){

            // Create folder
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guardar imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guardar en DB
            $propiedad->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Create</h1>

        <a href="/admin" class="boton boton-verde">Back</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php' ?>

            <input type="submit" value="Create Property" class="boton boton-verde" >
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>