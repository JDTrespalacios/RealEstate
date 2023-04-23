<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contact</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img lodading="lazy" src="build/img/destacada3.jpg" alt="Imagend de contacto">
        </picture>

        <h2>Fill out the Contact Form</h2>
        <form class="formulario" action="">
            <fieldset>
                <legend>Personal Information</legend>

                <label for="nombre">Name</label>
                <input type="text" placeholder="Your Name" id="nombre"></>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Your E-mail" id="email"></>

                <label for="telefono">Phone</label>
                <input type="tel" placeholder="Your Phone Number" id="telefono"></>

                <label for="mensaje">Message</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Property Information</legend>

                <label for="mensaje">Buy/Sell:</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Select --</option>
                    <option value="Compra">Buy</option>
                    <option value="Vende">Sell</option>
                </select>

                <label for="presupuesto">Price/Budget</label>
                <input type="number" placeholder="Your Price/Budget" id="presupuesto"></>
            </fieldset>

            <fieldset>
                <legend>Contact</legend>
                <p>How do you want to be contacted?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Phone</label>
                    <input name= "contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name= "contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>If you chose phone, choose the date and time</p>

                <label for="fecha">Date:</label>
                <input type="date" id="fecha"></>

                <label for="hora">Time:</label>
                <input type="time" id="hora" min="09:00" max="18:00"></>

            </fieldset>

            <input type="submit" value="Send" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>