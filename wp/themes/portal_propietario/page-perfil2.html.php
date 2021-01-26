<?php
/**
 * Template Name: page-perfil2.html
 * The template for displaying perfil2.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil2.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="row">
            <div class="side">
                <div class="fakeimg-perfil">
                    <img src="<?php echo get_template_directory() . '/assets/img/'?>perfil.png" style="width:200px;height: 200px;">
                </div>
                <hr>
                <h4 style="color:aliceblue;">Información personal <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                <p>Diego armando maradona</p>
                <p>30 de octubre de 1960</p>
                <hr>
                <h4 style="color:aliceblue;">Contacto <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                <p>Tlfn: 668995774</p>
                <p>Email: lamanodedios@gmail.com</p>
                <hr>
            </div>
            <div class="main-perfil">
                <div class="form-caracteristicas">
                    <div class="main-datos">
                        <div class="texto">
                            <h3>Datos del Inmueble </h3>
                            <hr>
                            <div class="datos-inmuebles">
                                <h4>Piso en Calle Fermin Muruguja, 24(28006)</h4>
                                <h4>Madrid</h4>
                                <p>120m2 - 3Hab. - Atico Exterior</p>
                            </div>
                        </div>
                        <div class="precios">
                            <div class="venta">
                                <h1>198.000€</h1>
                                <p>Precio de Venta</p>
                            </div>
                            <div class="valoracion">
                                <h1>156.000€</h1>
                                <p>Precio de Venta</p>
                            </div>
                        </div>
                    </div>

                    <div class="descripcion seccion-formulario">
                        <div class="pos-btn">
                            <h4>Descripción </h4>
                            <button onclick="editar(event)" class="botons editar" type="button">EDITAR</button><button onclick="guardar(event)" class="botons guardar" type="button">GURDAR</button>
                        </div>
                        <textarea name="comentarios" rows="10" cols="40">Descripción de la Vivienda</textarea>
                    </div>

                    <div class="caracteristicas-equipamiento seccion-formulario">

                        <div class="pos-btn">
                            <h4>Caracteristicas y Equipamiento </h4>

                            <button onclick="editar(event)" class="botons editar" type="button">EDITAR</button>
                            <button onclick="guardar(event)" class="botons guardar" type="button">GURDAR</button>

                        </div>
                        <div class="style-input">
                            <div class="primer-bloque">
                                <div class="linea-formulario">
                                    <input readonly="" class="controls" type="text" name="tipo de inmueble" id="tipo-inmueble" placeholder="Tipo de inmueble">
                                    <input readonly="" class="controls" type="text" name="estado" id="estado" placeholder="Estado">
                                    <input readonly="" class="controls" type="text" name="refenrecia" id="referencia" placeholder="Referencia">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="localizacion seccion-formulario">
                        <div class="pos-btn">
                            <h4>Localización</h4>
                            <button onclick="editar(event)" class="botons editar" type="button">EDITAR</button><button onclick="guardar(event)" class="botons guardar" type="button">GURDAR</button>

                        </div>
                        <div class="primer-bloque">
                            <div class="linea-formulario-localizacion">
                                <input readonly="" class="controls" type="text" name="provincia" id="provincia" placeholder="Provincia">
                                <input readonly="" class="controls" type="text" name="municipio" id="municipio" placeholder="Municipio">
                                <input readonly="" class="controls" type="text" name="poblacion" id="poblacion" placeholder="Población">
                            </div>
                        </div>
                        <div class="segundo-bloque">
                            <div class="linea-formulario-localizacion">
                                <input readonly="" class="controls" type="text" name="direccion" id="direccion" placeholder="Direccion">
                                <input readonly="" class="controls" type="text" name="tipo-de-via" id="tipo-de-via" placeholder="Tipo de Via">
                                <input readonly="" class="controls" type="text" name="codigo-postal" id="codigo-postal" placeholder="Codigo Postal">
                            </div>
                        </div>
                        <div class="tercer-bloque">
                            <div class="linea-formulario-localizacion">
                                <input readonly="" class="controls" type="text" name="numero" id="numero" placeholder="Numero">
                                <input readonly="" class="controls" type="text" name="escalera" id="escalera" placeholder="Escalera">
                                <input readonly="" class="controls" type="text" name="puerta" id="puerta" placeholder="Puerta">
                            </div>
                        </div>
                    </div>
                    <div class="superficie seccion-formulario">
                        <div class="pos-btn">
                            <h4>Superficie</h4>
                            <button onclick="editar(event)" class="botons editar" type="button">EDITAR</button><button onclick="guardar(event)" class="botons guardar" type="button">GURDAR</button>
                        </div>
                        <div class="primer-bloque">
                            <input readonly="" class="controls" type="text" name="metros-contruido" id="metros-contruido" placeholder="M2 contruido">
                            <input readonly="" class="controls" type="text" name="metro-utiles" id="metro-utiles" placeholder="M2 utiles">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-fotos">
            <div class="btn-imagenes">
                <h4>Fotografias <input class="botons editar" type="submit" value="EDITAR"> <input class="botons" type="submit" value="EXAMINAR"> <input class="botons guardar" type="submit" value="GUARDAR">
                    <hr>
                </h4>
                <div class="fotos">
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<?php echo get_template_directory() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                        <div class="container">
                            <h4><b>Frontal casa</b></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();