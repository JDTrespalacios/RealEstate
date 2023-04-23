<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Our Blog</h1>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terrace on the roof of your house</h4>
                    <p>Written on: <span>4/14/2023</span> by: <span>Admin</span></p>

                    <p>
                        Tips for building a terrace on the roof of your house with the best materials and saving money
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guide to decorating your home</h4>
                    <p>Written on: <span>4/14/2023</span> by: <span>Admin</span></p>

                    <p>
                        Maximize the space in your home with this guide, learn to combine furniture and colors to give life to your space
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog3.webp" type="image/webp">
                    <source srcset="build/img/blog3.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog3.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terrace on the roof of your house</h4>
                    <p>Written on: <span>4/14/2023</span> by: <span>Admin</span></p>

                    <p>
                        Tips for building a terrace on the roof of your house with the best materials and saving money
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog4.webp" type="image/webp">
                    <source srcset="build/img/blog4.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog4.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guide to decorating your home</h4>
                    <p>Written on: <span>4/14/2023</span> by: <span>Admin</span></p>

                    <p>
                    Maximize the space in your home with this guide, learn to combine furniture and colors to give life to your space
                    </p>
                </a>
            </div>
        </article>
    </main>

<?php
    incluirTemplate('footer');
?>