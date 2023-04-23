<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }

    // Database
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Array with error messages

    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

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

        // Asignar files a una variable
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
        
        if (!$imagen['name'] || $imagen['error']) {
            $errores[] = "Image is mandatory";
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

            /** SUBIDA DE ARCHIVOS **/

            // Create folder
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generate a unique name
            $nombreImagen = md5( uniqid( rand(), true )) . ".jpg";

            // Upload image

            move_uploaded_file ($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

            
            //INSERTAR EN DATABASE
            $query = " INSERT INTO propiedades (titulo, precio, imagen,  descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

            // echo $query;
    
            $resultado = mysqli_query($db, $query);
    
            if($resultado){
                // Redirect user
                header('Location: /admin?resultado=1');
            }
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
            <fieldset>
                <legend>General Information</legend>

                <label for="titulo">Title:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Property Title" value="<?php echo $titulo; ?>">

                <label for="precio">Price:</label>
                <input type="number" id="precio" name="precio" placeholder="Property Price" value="<?php echo $precio; ?>">

                <label for="imagen">Image:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Description:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $titulo; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Property Information</legend>

                <label for="habitaciones">Bedrooms:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ex: 3" 
                    min="1" max="9" 
                    value="<?php echo $habitaciones ?>">

                <label for="wc">WCs:</label>
                <input type="number" id="wc" name="wc" placeholder="Ex: 3" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Garage:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ex: 3" min="1" max="9" value="<?php echo $estacionamiento ?>">
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

            <input type="submit" value="Create Property" class="boton boton-verde" >
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>