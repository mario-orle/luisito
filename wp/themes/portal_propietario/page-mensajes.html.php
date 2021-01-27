<?php
/**
 * Template Name: page-mensajes.html
 * The template for displaying mensajes.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/mensajes.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="chat">
            <div class="contactos">
                <?php
for ($i=0; $i<3; $i++) {
                ?>
                <div class="contacto">
                    <img class="contacto-img" src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" />
                    <div class="contacto-name">Ramón el vanidoso</div>
                    <div class="contacto-unread">3</div>
                </div>
                <?php
}
                ?>
            </div>
            <div class="mensajes-enviar">
                <div class="mensajes">
                    <?php
for ($i=0; $i<3; $i++) {
                    ?>
                    <div class="mensaje">
                        <div class="author">
                            <img class="author-img" src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" />
                            <div class="author-name">Ramón el vanidoso</div>
                        </div>
                        <div class="mensaje-txt">bla bla bla bla bla bla bla</div>
                    </div>
                    <?php
}
                    ?>

                </div>
                <div class="enviar">
                    <textarea></textarea>
                    <button>Enviar</button>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();