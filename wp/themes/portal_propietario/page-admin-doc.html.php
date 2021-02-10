<?php
/**
 * Template Name: page-doc-admin.html
 * The template for displaying doc-admin.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/doc-admin.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-documentos">
            <div class="documentos-descarga">
                <div class="text-documentos">
                    <h3>Documentos Solicitados por el Cliente:
                        <hr>
                    </h3>
                    <div class="fila-documento">
                        <p>Certificado_de_eficiencia_energetica.pdf</p>

                        <input type="checkbox" id="test1">
                        <label for="test1"></label>

                    </div>
                    <div class="fila-documento">
                        <p>Book_de_fotos_profesional.zip</p>

                        <input type="checkbox" id="test2">
                        <label for="test2"></label>

                    </div>
                    <div class="fila-documento">
                        <p>Celula_de_habitabilidad.pdf</p>

                        <input type="checkbox" id="test3">
                        <label for="test3"></label>

                    </div>
                    <div class="fila-documento">
                        <p>Nota_simple_e_informe_juridico.pdf</p>

                        <input type="checkbox" id="test4">
                        <label for="test4"></label>

                    </div>
                </div>
            </div>
            <div class="documentos-descarga-2">
                <div class="text-documentos">
                    <h3>Envio de Documentos para el Cliente:
                        <hr>
                    </h3>
                    <div class="fila-documento-2">
                        <p>Certificado_de_eficiencia_energetica.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="ENVIAR">
                            <input class="botons" type="submit" value="CARGAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Book_de_fotos_profesional.zip</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="ENVIAR">
                            <input class="botons" type="submit" value="CARGAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Celula_de_habitabilidad.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="ENVIAR">
                            <input class="botons" type="submit" value="CARGAR">
                        </div>
                    </div>

                    <div class="fila-documento-2">
                        <p>Nota_simple_e_informe_juridico.pdf</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="ENVIAR">
                            <input class="botons" type="submit" value="CARGAR">
                        </div>
                    </div>
                </div>
            </div>
            <div class="documentos-descarga-2">
                <div class="text-documentos">
                    <h3>Solicitar Documentos al Cliente:
                        <hr>
                    </h3>
                    <div class="fila-documento-2">
                        <p>Certificado de pagos del Inmueble</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="SOLICITAR">
                            <input class="botons" type="submit" value="DESCARGAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Planos del Inmueble</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="SOLICITAR">
                            <input class="botons" type="submit" value="DESCARGAR">
                        </div>
                    </div>
                    <div class="fila-documento-2">
                        <p>Celula_de_habitabilidad</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="SOLICITAR">
                            <input class="botons" type="submit" value="DESCARGAR">
                        </div>
                    </div>

                    <div class="fila-documento-2">
                        <p>Certificado Pago de Cuota Comunidad de Vecinos</p>
                        <div class="btn-container">
                            <input class="botons" type="submit" value="SOLICITAR">
                            <input class="botons" type="submit" value="DESCARGAR">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();