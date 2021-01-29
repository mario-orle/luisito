<?php
/**
 * Template Name: page-cargar-inmueble.html
 * The template for displaying cargar-inmueble.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/cargar-inmueble.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="descripcion-inmueble">
            <form>
                <h1>DESCRIPCIÓN INMUEBLE</h1>
                <div class="primera-linea linea-formulario">
                    <input type="text" placeholder="tipo de Inmueble">
                    <input type="text" placeholder="Estado">
                    <input type="text" placeholder="referencia">
                </div>
                <div class="segunda-linea linea-formulario">
                    <input type="text" placeholder="Pais">
                    <input type="text" placeholder="Provincia">
                    <input type="text" placeholder="Municipio">
                </div>
                <div class="tercera-linea linea-formulario">
                    <input type="text" placeholder="Tipo de via">
                    <input type="text" placeholder="Direccion">
                    <input type="text" placeholder="Codigo postal">
                </div>
                <div class="cuarta-linea linea-formulario">
                    <input type="text" placeholder="Numero">
                    <input type="text" placeholder="Puerta">
                    <input type="text" placeholder="Escalera">
                </div>


                <div class="quinta-linea linea-formulario">
                    <div class="left">
                        <input type="text" placeholder="M2 Construidos">
                        <input type="text" placeholder="M2 Útiles">
                    </div>

                    <div class="right">
                        <select>
                            <optgroup label="Contrato>"></optgroup>
                            <option value="Alquiler">Alquiler</option>
                            <option value="Venta">Venta</option>

                        </select>
                    </div>
                </div>

                <div class="descripcion">
                    <textarea>Escribe descripción</textarea>
                </div>
                <div class="enviar">

                    <div class="terminos-condiciones">
                        <input type="checkbox"> Estoy de acuerdo con los <a href="#Terminos-condiciones"> Terminos y
                            Condiciones</a>
                    </div>
                    <button type="submit" value="Submit">Enviar</button>
                </div>

            </form>
            <div class="img-desc-inmueble">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eco-home.png" style="width: 100%;">
            </div>

        </div>


        <div class="cargar-imagenes">
            <div class="text">
                <form action="/action_page.php">
                    <label for="myfile">Click para subir</label>
                    <a class="boton_personalizado" href="https://google.com">enviar</a>
                    <input type="file" id="myfile" name="myfile">
                </form>
            </div>

            <div class="scroller">
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
                <div class="editar-tirar-doc">
                    <div class="estilo-doc">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>documentos.png" alt="icono" style="width:32px">
                        <p>Patatas</p>
                    </div>
                    <div>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>eliminar.png" alt="icono" style="width:32px"></button>
                        <button><img src="<?php echo get_template_directory_uri() . '/assets/img/'?>editar.png" alt="icono" style="width:32px;"></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();