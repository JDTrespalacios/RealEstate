<?php
    // Includes Header
    require 'includes/app.php';
    $db = conectarDB();

    // Authenticate user

    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "Email is invalid";
        }

        if(!$password) {
            $errores[] = "Password is mandatory";
        }

        if(empty($errores)){

            //Check whether the user exists
            $query = "SELECT * FROM usuarios WHERE email = '{$email}' ";
            $resultado = mysqli_query($db, $query);

            if( $resultado->num_rows ){
                // Check whether the password is correct
                $usuario = mysqli_fetch_assoc($resultado);

                // Verify if the password is correct

                $auth = password_verify($password, $usuario['password']);

                if ($auth){
                    // User has been authenticated
                    session_start();

                    // Session array 
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "Incorrect password";
                }

            } else {
                $errores[] = "User does not exist";
            }
        }
    }


    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Login</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email & Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required></>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required></>
            </fieldset>

            <input type="submit" value="Log In" class="boton boton-verde"> 
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>