<?php
/**
 * Template Name: page-doc-mobile.html
 * The template for displaying doc-mobile.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/doc-mobile.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-documentos">
            <div class="documentos">
                <div class="text-documentos">
                    <h2>Documentos <i class="fas fa-file"></i>
                        <hr>
                    </h2>
                    <div class="stilo-contenedor">
                        <button type="button" class="collapsible">Documentos Recibidos</button>
                        <div class="content">
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
                    <div class="stilo-contenedor">
                        <button type="button" class="collapsible">Documentos Necesarios</button>
                        <div class="content">
                            <div class="fila-documento">
                                <p>Certificado_de_eficiencia_energetica.pdf</p><input class="botons" type="submit" value="CARGAR"><input class="botons" type="submit" value="SOLICITAR">
                            </div>
                            <div class="fila-documento">
                                <p>Book_de_fotos_profesional.zip</p><input class="botons" type="submit" value="CARGAR"><input class="botons" type="submit" value="SOLICITAR">
                            </div>
                            <div class="fila-documento">
                                <p>Celula_de_habitabilidad.pdf</p><input class="botons" type="submit" value="CARGAR"><input class="botons" type="submit" value="SOLICITAR">
                            </div>
                            <div class="fila-documento">
                                <p>Nota_simple_e_informe_juridico.pdf</p><input class="botons" type="submit" value="CARGAR"><input class="botons" type="submit" value="SOLICITAR">
                            </div>
                        </div>
                    </div>
                    <div class="stilo-contenedor">
                        <button type="button" class="collapsible">Documentos Solicitados</button>
                        <div class="content">
                            <div class="fila-documento">
                                <p>Certificado_de_eficiencia_energetica.pdf</p>
                            </div>
                            <div class="fila-documento">
                                <p>Book_de_fotos_profesional.zip</p>
                            </div>
                            <div class="fila-documento">
                                <p>Celula_de_habitabilidad.pdf</p>
                            </div>
                            <div class="fila-documento">
                                <p>Nota_simple_e_informe_juridico.pdf</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();