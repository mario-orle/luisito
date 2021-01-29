<?php
/**
 * Template Name: page-alerta-asesor.html
 * The template for displaying alerta-asesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/alerta-asesor.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="container">
            <div class="perfil-asesor">
                <div class="img-perfil-asesor">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>hombre-traje.png" alt="icono" width="100%">
                </div>
                <div class="form-perfil">
                    <form>
                        <h1>PERFIL ASESOR
                            <hr>
                        </h1>
                        <div class="Nombre">
                            <h3>Nombre Asesor</h3>
                            <p>Luis Gabaldon</p>
                        </div>
                        <div class="email">
                            <h3>E-mail Asesor</h3>
                            <p>Luis.gabaldon.asesor@miracasa.com</p>
                        </div>
                        <div class="doc-punt">
                            <div class="documentacion-puntual">
                                <h3>Documentación Puntual</h3>
                            </div>
                            <div class="fila-documento">
                                <p>Certificado_de_eficiencia_energetica.pdf</p>
                                <input class="botons" type="submit" value="DESCARGAR">
                                <input class="botons" type="submit" value="SOLICITAR">
                                <input class="botons" type="submit" value="EXAMINAR">
                            </div>
                            <div class="fila-documento">
                                <p>Vienes_de_comunidad.pdf</p>
                                <input class="botons" type="submit" value="DESCARGAR">
                                <input class="botons" type="submit" value="SOLICITAR">
                                <input class="botons" type="submit" value="EXAMINAR">
                            </div>
                            <div class="fila-documento">
                                <p>Pago_comunidad.pdf</p>
                                <input class="botons" type="submit" value="DESCARGAR">
                                <input class="botons" type="submit" value="SOLICITAR">
                                <input class="botons" type="submit" value="EXAMINAR">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();