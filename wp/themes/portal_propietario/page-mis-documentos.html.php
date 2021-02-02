<?php
/**
 * Template Name: page-mis-documentos.html
 * The template for displaying mis-documentos.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/mis-documentos.css?cb=' + generate_random_string() + '">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-documentos">
            <div class="documentos-descarga">
                <div class="text-documentos">
                    <h3>Documentos para ti:
                        <hr>
                    </h3>
                    <div class="fila-documento">
                        <p>Certificado_de_eficiencia_energetica.pdf</p><input class="botons" type="submit" value="GUARDAR">
                    </div>
                    <div class="fila-documento">
                        <p>Book_de_fotos_profesional.zip</p><input class="botons" type="submit" value="GUARDAR">
                    </div>
                    <div class="fila-documento">
                        <p>Celula_de_habitabilidad.pdf</p><input class="botons" type="submit" value="GUARDAR">
                    </div>
                    <div class="fila-documento">
                        <p>Nota_simple_e_informe_juridico.pdf</p><input class="botons" type="submit" value="GUARDAR">
                    </div>
                </div>
            </div>
            <div class="documentos-descarga-2">
                <div class="text-documentos">
                    <h3>Documentos Requeridos:
                        <hr>
                    </h3>
                    <div class="fila-documento-2">
                        <p>Certificado_de_eficiencia_energetica.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="CARGAR">
                            <input class="botons" type="submit" value="SOLICITAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Book_de_fotos_profesional.zip</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="CARGAR">
                            <input class="botons" type="submit" value="SOLICITAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Celula_de_habitabilidad.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="CARGAR">
                            <input class="botons" type="submit" value="SOLICITAR">
                        </div>
                    </div>

                    <div class="fila-documento-2">
                        <p>Nota_simple_e_informe_juridico.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="CARGAR">
                            <input class="botons" type="submit" value="SOLICITAR">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();