<?php
/**
 * Template Name: page-inicio.html
 * The template for displaying inicio.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/inicio.css?cb=' . generate_random_string() . '">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-container">
            <h2>Estadisticas Generales</h2>

            <br>
            <div class="estadisticas">
                <div class="visualizaciones">

                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>lupa.png" width="100%">
                    <h1>3</h1>
                    <p>Ofertas Recibidas</p>
                </div>
                <div class="contacto-email">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
                    <h1>5</h1>
                    <p>Mensajes Sin Leer</p>

                    

                </div>
                <div class="calendario">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                    <h1>3</h1>
                    <p>Citas por Confirmar</p>
                </div>
                <div class="porcentaje-perfil">

                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" width="100%">
                    <h1>6</h1>
                    <p>Documento Requeridos</p>

                </div>
            </div>
        </div>
        <div class="main-container-sub">
            <h2>Evolución de la Vivienda</h2>

            <br>
            <div class="estadisticas-sub">
                <div class="precio-medio">
                    <p>Precio Medio de Venta en la Zona</p>
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>grafica.png" width="100%">
                </div>
                <div class="tipos-precio">
                    <div class="precio-venta">
                        <h1>150.000€ </h1>
                        <p>Precio de venta <i class="fas fa-hand-holding-usd"></i> </p>
                    </div>
                    <div class="precio-recomendado">
                        <h1>175.000€</h1>
                        <p>Precio Recomendado <i class="fas fa-hand-holding-usd"></i></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();