<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Know About Us</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture >
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading= "lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture> 
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 Years of Experience
                </blockquote>
                <p>Fusce ac sapien et augue condimentum vehicula sed eu enim. Suspendisse venenatis, neque eu elementum volutpat, nisi arcu semper lorem, eu posuere nibh magna eu leo. Sed at sapien non tellus sagittis aliquet a at nunc. Nulla et lectus et quam tristique malesuada sit amet auctor augue. Etiam nec ante volutpat nulla dignissim egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer ac bibendum nisl. Donec feugiat efficitur arcu, eu congue augue bibendum vitae.Nulla quis tincidunt nisl. In id placerat neque. Vestibulum quis interdum velit. Sed felis ipsum, faucibus in felis non, interdum eleifend nisi. Sed egestas lorem vel pellentesque vehicula. Curabitur nec nulla ut augue sollicitudin viverra ut sed nisl. Curabitur lobortis metus vel fringilla faucibus. Aliquam maximus risus ac rutrum feugiat.</p>
            
                <p>Ut vehicula eros nibh, sed gravida nibh dignissim vitae. Aliquam quis bibendum massa. Sed sed blandit quam, ut dapibus tellus. Proin bibendum euismod sapien nec elementum. Integer a faucibus ipsum.  </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>More About Us</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Security</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nam dolore autem sit perferendis quis aliquid eum doloribus, alias accusamus minima maxime error assumenda adipisci amet optio repellendus harum enim.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Price</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nam dolore autem sit perferendis quis aliquid eum doloribus, alias accusamus minima maxime error assumenda adipisci amet optio repellendus harum enim.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Time</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nam dolore autem sit perferendis quis aliquid eum doloribus, alias accusamus minima maxime error assumenda adipisci amet optio repellendus harum enim.</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>