<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guide to decorating your home</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>
        
        <p class="informacion-meta">Written on: <span>4/14/2023</span> by: <span>Admin</span></p>
        
        <div class="resumen-propiedad">
            <p>Fusce ac sapien et augue condimentum vehicula sed eu enim. Suspendisse venenatis, neque eu elementum volutpat, nisi arcu semper lorem, eu posuere nibh magna eu leo. Sed at sapien non tellus sagittis aliquet a at nunc. Nulla et lectus et quam tristique malesuada sit amet auctor augue. Etiam nec ante volutpat nulla dignissim egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer ac bibendum nisl. Donec feugiat efficitur arcu, eu congue augue bibendum vitae.Nulla quis tincidunt nisl. In id placerat neque. Vestibulum quis interdum velit. Sed felis ipsum, faucibus in felis non, interdum eleifend nisi. Sed egestas lorem vel pellentesque vehicula. Curabitur nec nulla ut augue sollicitudin viverra ut sed nisl. Curabitur lobortis metus vel fringilla faucibus. Aliquam maximus risus ac rutrum feugiat.</p>
            
            <p>Ut vehicula eros nibh, sed gravida nibh dignissim vitae. Aliquam quis bibendum massa. Sed sed blandit quam, ut dapibus tellus. Proin bibendum euismod sapien nec elementum. Integer a faucibus ipsum.  </p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>