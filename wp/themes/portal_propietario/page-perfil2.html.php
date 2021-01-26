<?php
/**
 * Template Name: page-perfil2.html
 * The template for displaying perfil2.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */


$inmueble = get_posts(array(
    'post_type' => 'inmueble',
    'post_author' => get_current_user_id()
))[0];

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil2.css">';
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/ext/dropzone.min.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>
<main id="primary" class="site-main">
    <div class="main">
        <div class="row">
            <div class="side">
                <div class="fakeimg-perfil">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" style="width:200px;height: 200px;">
                </div>
                <hr>
                <h4 style="color:aliceblue;">Información personal <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                <p><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-name', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname2', true) ?></p>
                <p>
                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-birth-day', true) ?> 
                    de 
                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-birth-month', true) ?>  
                    de 
                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-birth-year', true) ?> 
                </p>
                <hr>
                <h4 style="color:aliceblue;">Contacto <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                <p>Tlfn: <a href="tel:<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-phone', true) ?>"><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-phone', true) ?></a></p>
                <p>Email: <a href="mailto:<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-email', true) ?>"><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-email', true) ?></a></p>
                <hr>
            </div>
            <div class="main-perfil">
                <div class="form-caracteristicas">
                    <div class="main-datos">
                        <div class="texto">
                            <h3>Datos del Inmueble </h3>
                            <hr>
                            <div class="datos-inmuebles">
                                <h4>
                                    Inmueble en
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true) ?>
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-numero', true) ?>
                                    (<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true) ?>)

                                </h4>
                                <h4>
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true) ?>
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-provincia', true) ?>
                                </h4>
                                <p>
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true) ?> m2 construidos
                                    -
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true) ?> m2 útiles
                                    -
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true) ?> Hab.
                                    -
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-escalera', true) ?>
                                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-puerta', true) ?>
                                </p>
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
                        <textarea readonly name="inmueble-comentarios" rows="10" cols="40" placeholder="Descripción de la Vivienda">
                        <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-comentarios', true) ?>
                        </textarea>
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
                                    <input readonly="" class="controls" type="text" name="inmueble-tipo" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) ?>" placeholder="Tipo de inmueble">
                                    <input readonly="" class="controls" type="text" name="inmueble-estado" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) ?>" placeholder="Estado">
                                    <input readonly="" class="controls" type="text" name="inmueble-referencia" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-referencia', true) ?>" placeholder="Referencia">
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
                                <input readonly="" class="controls" type="text" name="inmueble-provincia" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-provincia', true) ?>" placeholder="Provincia">
                                <input readonly="" class="controls" type="text" name="inmueble-municipio" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true) ?>" placeholder="Municipio">
                                <input readonly="" class="controls" type="text" name="inmueble-poblacion" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true) ?>" placeholder="Población">
                            </div>
                        </div>
                        <div class="segundo-bloque">
                            <div class="linea-formulario-localizacion">
                                <input readonly="" class="controls" type="text" name="inmueble-direccion" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true) ?>" placeholder="Direccion">
                                <input readonly="" class="controls" type="text" name="inmueble-codigopostal" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true) ?>" placeholder="Codigo Postal">
                            </div>
                        </div>
                        <div class="tercer-bloque">
                            <div class="linea-formulario-localizacion">
                                <input readonly="" class="controls" type="text" name="inmueble-numero" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-numero', true) ?>" placeholder="Numero">
                                <input readonly="" class="controls" type="text" name="inmueble-escalera" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-escalera', true) ?>" placeholder="Escalera">
                                <input readonly="" class="controls" type="text" name="inmueble-puerta" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-puerta', true) ?>" placeholder="Puerta">
                            </div>
                        </div>
                    </div>
                    <div class="superficie seccion-formulario">
                        <div class="pos-btn">
                            <h4>Superficie</h4>
                            <button onclick="editar(event)" class="botons editar" type="button">EDITAR</button><button onclick="guardar(event)" class="botons guardar" type="button">GURDAR</button>
                        </div>
                        <div class="primer-bloque">
                            <input readonly="" class="controls" type="text" name="inmueble-habitaciones" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true) ?>" placeholder="Habitaciones">
                            <input readonly="" class="controls" type="text" name="inmueble-m2construidos" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true) ?>" placeholder="M2 contruido">
                            <input readonly="" class="controls" type="text" name="inmueble-m2utiles" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true) ?>" placeholder="M2 utiles">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-fotos">
            <div class="btn-imagenes">
                <h4>Fotografias
                    <hr>
                </h4>
                <div class="uploader">
                    <form action="/file-upload?action=upload-photo-inmueble&inmueble_id=<?php echo $inmueble->ID ?>"
                        class="dropzone"
                        id="dropzone"></form>
                </div>
                <div class="fotos">
                <?php

$photos = get_post_meta($inmueble->ID, 'meta-photos-inmueble');
foreach ($photos as $photo) {
                ?>
                <div class="card">
                    <img src="<?php echo $photo['url'] ?>" alt="" style="width:100%">
                    <div class="container">
                        <h4><b>Frontal casa</b></h4>
                    </div>
                </div>
                <?php
}
                ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->
<script src="<?php echo get_bloginfo('stylesheet_directory').'/assets/ext/dropzone.min.js'; ?>"></script>

<script>

Dropzone.options.dropzone = {
  init: function() {
    this.on("success", function(file, response) { 
        var objResponse = JSON.parse(response);
        var newImg = '<div class="card">' +
            '<img src="' + objResponse.url + '" alt="" style="width:100%">' +
            '<div class="container">' +
                '<h4><b>Frontal casa</b></h4>' +
            '</div>' +
        '</div>';

        document.querySelector('.bg-fotos .fotos').innerHTML += newImg;

        this.removeFile(file);
    });
  }
};

Dropzone.options.dropzone.dictDefaultMessage = "Arrastre imágenes aquí o haga click";
Dropzone.options.dropzone.dictFallbackMessage = "Haga click aquí para subir imágenes";
Dropzone.options.dropzone.dictFallbackText = "";
Dropzone.options.dropzone.dictFileTooBig = "Imágenes demasiado grandes";
Dropzone.options.dropzone.dictInvalidFileType = "Por favor, sólo imágenes";
Dropzone.options.dropzone.dictResponseError = "Error en la subida";


function editar(e){
    var inputs = e.currentTarget.parentElement.parentElement.querySelectorAll("input[readonly], textarea[readonly]");
    var botonguardar = e.currentTarget.parentElement.querySelector(".guardar");
    botonguardar.style.display ="inline-block";
    e.currentTarget.style.display ="none";
    Array.from(inputs).forEach(function (input){
        input.removeAttribute("readonly");
    })
}
function guardar(e){
    var inputs = e.currentTarget.parentElement.parentElement.querySelectorAll("input, textarea");
    var botoneditar = e.currentTarget.parentElement.querySelector(".editar");
    botoneditar.style.display = "inline-block";
    e.currentTarget.style.display = "none";
    Array.from(inputs).forEach(function (input){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/inmueble-xhr?action=update_metadata&inmueble_id=<?php echo $inmueble->ID ?>");

        var formData = new FormData();

        formData.append('metaname', input.getAttribute("name"));     
        formData.append('metavalue', input.value);     


        xhr.onload = function () {
            this.style.filter = "none";

        }.bind(input);
        xhr.send(formData);
        input.style.filter = "blur(1px)";
        input.setAttribute("readonly","true")
    })
}

</script>
<?php
get_footer();