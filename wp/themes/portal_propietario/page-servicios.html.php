<?php
/**
 * Template Name: page-servicios.html
 * The template for displaying servicios.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/servicios.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-container">
            <h2>SERVICIOS PLUS</h2>

            <br>
            <div class="servicios-plus">
                <div>
                    <button a="" href="#" class="notario">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>agente.png" width="100%">
                        <h2>Notario</h2>
                        <p>Ponemos a su disposición los mejores Despachos de Notarios para su Contratación</p>
                    </button>
                </div>
                <div>
                    <button a="" href="#" class="certificado-energetico">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>clase-energetica.png" width="100%">
                        <h2>Certificado Energetico</h2>
                        <p>Tasación y Valoración Energetica de su Vivienda</p>
                    </button>
                </div>
                <div>
                    <button a="" href="#" class="nota-simple">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>escritura.png" width="100%">
                        <h2>Nota Simple</h2>
                        <p>Podra Adquirir su Nota Simple a Traves de Nuestros Asesores</p>
                    </button>
                </div>
                <div>
                    <button a="" href="#" class="reportaje-fotografico">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>galeria.png" width="100%">
                        <h2>Reportaje Fotografico y Plano</h2>
                        <p>Ponemos a su Disposicion los Mejores Fotografos del Momento</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();