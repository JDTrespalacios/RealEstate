<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }

    // Validate URL by ID
    
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header ('Location: /admin');
    }

    // Database
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Get property data
    $consulta = "SELECT * FROM propiedades WHERE id = {$id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);


    // Query to get the sellers
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Array with error messages

    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    // Run after a user sends the form

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES); 
        // echo "</pre>";

        // exit;

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedorId']);
        $creado = date('Y/m/d');

        // Assign files to a variable
        $imagen = $_FILES['imagen'];


        if (!$titulo) {
            $errores[] = "You must insert a title";
        }

        if (!$precio) {
            $errores[] = "The 'price' field is mandatory";
        }

        if (strlen($descripcion) < 50) {
            $errores[] = "The 'description' field must have at least 50 characters";
        }

        if (!$habitaciones) {
            $errores[] = "The 'habitaciones' field is mandatory";
        }

        if (!$wc) {
            $errores[] = "The 'wc' field is mandatory";
        }

        if (!$estacionamiento) {
            $errores[] = "The 'estacionamiento' field is mandatory";
        }

        if (!$vendedorId) {
            $errores[] = "Choose a seller";
        }

        // Validate by size (1MB max)
        $medida = 1000 * 1000;

        if ($imagen['size'] > $medida) {
            $errores[] = "Inserted image is too large";
        }


        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // CHECK IF THE $errores ARRAY IS EMPTY

        if (empty($errores)){

            // Create folder
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /** FILES UPLOAD **/

            if ($imagen['name']) {
                // Delete previous image

                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generate a unique name
                $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";
    
                // Upload image
    
                move_uploaded_file ($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            } else {
                $nombreImagen = $propiedad['imagen'];
            }


            //INSERT TO DATABASE
            $query = " UPDATE propiedades SET titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, estacionamiento = {$estacionamiento}, vendedorId = {$vendedorId} WHERE id = {$id} ";

            // echo $query;
    
            $resultado = mysqli_query($db, $query);
    
            if($resultado){
                // Redirect user
                header('Location: /admin?resultado=2');
            }
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
            <fieldset>
                <legend>General Information</legend>

                <label for="titulo">Title:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Price:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Image:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

                <label for="descripcion">Description:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Porperty Information</legend>

                <label for="habitaciones">Bedrooms:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ej: 3" 
                    min="1" max="9" 
                    value="<?php echo $habitaciones ?>">

                <label for="wc">WCs:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Garage:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

            <fieldset>
                <legend>Seller</legend>

                <select name="vendedorId">
                    <option value="">-- Select --</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']  ?> </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Update Property" class="boton boton-verde" >
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>