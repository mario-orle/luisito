<?php

/**
 * Template Name: page-perfil2.html
 * The template for displaying perfil2.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";

$inmueble = get_posts(array(
    'post_type' => 'inmueble',
    'author' => get_current_user_id()
))[0];

if (current_user_can('administrator') && !empty($_GET['user'])) {
    $inmueble = get_posts(array(
      'post_type' => 'inmueble',
      'author' => $_GET['user']
    ))[0];
}

function myCss()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/perfil2.css?cb=' . generate_random_string() . '">';
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/ext/dropzone.min.css?cb=' . generate_random_string() . '">';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>';
    echo '<script src="'.get_bloginfo('stylesheet_directory').'/assets/ext/moment.min.js?cb=' . generate_random_string() . '"></script>';

}
add_action('wp_head', 'myCss');


get_header();
?>
<main id="primary" class="site-main">
    <div class="main">

    <?php
if (current_user_can('administrator')) {
    ?>
    <div class="admin-perfil">
      <h4>Eres administrador, si rellenas el formulario, crearás un nuevo usuario e irás a su perfil, o podrás crearlo si aún no lo tiene.</h4>

      <p>Si quieres ver el perfil de un usuario creado, usa este selector</p>
      <select class="js-choice" onchange="window.location.href = '/perfil?user=' + this.value">
        <option value=""></option>

      <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user) {
    if (get_user_meta($user->ID, 'meta-gestor-asignado', true) == get_current_user_id()) {
        if ( $_GET['user'] == $user->ID) {

      ?>
        <option selected value="<?php echo $user->ID ?>"><?php echo $user->display_name ?></option>
      <?php
        } else {
      ?>
          <option value="<?php echo $user->ID ?>"><?php echo $user->display_name ?></option>
      <?php
        }
    }
}
      ?>
      </select>
    </div>
    <?php
}
    ?>
        <div class="row">
            <div class="side">
                <div class="fakeimg-perfil">
                    <img class="user-logo-auto" src="<?php echo get_template_directory_uri() . '/assets/img/' ?>perfil.png" style="width:200px;height: 200px;">
                </div>
                <hr>
                <h4 style="color:aliceblue;">Información personal <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                <p>
                    <?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-name', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-owner-lastname2', true) ?>
                </p>
                <p id="fecha-nacimiento">
                    
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
                                </p>
                            </div>
                        </div>
                        <div class="precios">
                            <div class="venta">
                                <input name="inmueble-preciodeseado" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-preciodeseado', true) ?>" onchange="editar(event)" />
                                <p>Precio deseado</p>
                            </div>
                            <div class="valoracion">
                                <input name="inmueble-preciovaloracion" type="text" 
                                    value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-preciovaloracion', true) ?>" 
                                    <?php if (current_user_can('administrator')) { ?>onchange="editar(event)"<?php } else { ?> readonly <?php } ?>  
                                />
                                <p>Precio de Venta</p>
                            </div>
                        </div>
                    </div>



                    <div class="main-formulario">
                        <div class="caracteristicas">
                            <h3>Caracteristicas:</h3>
                            <hr />
                            <form>
                                <div class="first-block formulario">
                                    <input onchange="editar(event)" type="text" name="inmueble-tipo" class="question" placeholder="" id="tipo" required autocomplete="off" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-tipo', true) ?>" />
                                    <label for="tipo">
                                        <span>Tipo de Inmueble</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input onchange="editar(event)" type="text" name="inmueble-estado" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-estado', true) ?>" class="question" placeholder="" id="estado" required autocomplete="off" />
                                    <label for="estado">
                                        <span>Estado del Inmueble</span>
                                    </label>
                                </div>
                            <div class="first-block formulario">
                                <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-habitaciones', true) ?>" name="inmueble-habitaciones" class="question" placeholder="" id="habitas" required autocomplete="off" />
                                <label for="habitas">
                                    <span>Habitaciones</span>
                                </label>
                            </div>
                            <div class="first-block formulario">
                                <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2construidos', true) ?>" name="inmueble-m2construidos" class="question" placeholder="" id="m2c" required autocomplete="off" />
                                <label for="m2c">
                                    <span>M2 Construidos</span>
                                </label>
                            </div>
                            <div class="first-block formulario">
                                <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-m2utiles', true) ?>" name="inmueble-m2utiles" class="question" placeholder="" id="m2u" required autocomplete="off" />
                                <label for="m2u">
                                    <span>M2 Útiles</span>
                                </label>
                            </div>
                            </form>


                        </div>
                        <div class="localizacion">
                            <h3>Localización:</h3>
                            <hr />
                            <form>
                                <div class="first-block formulario">
                                    <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-provincia', true) ?>" name="inmueble-provincia" class="question" placeholder="" id="pro" required autocomplete="off" />
                                    <label for="pro">
                                        <span>Provincia</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-municipio', true) ?>" name="inmueble-municipio" class="question" placeholder="" id="mun" required autocomplete="off" />
                                    <label for="mun">
                                        <span>Municipio</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true) ?>" name="inmueble-poblacion" class="question" placeholder="" id="pob" required autocomplete="off" />
                                    <label for="pob">
                                        <span>Población</span>
                                    </label>
                                </div>
                            </form>
                            <div class="first-block formulario">
                                <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true) ?>" name="inmueble-direccion" class="question" placeholder="" id="dir" required autocomplete="off" />
                                <label for="dir">
                                    <span>Dirección Completa</span>
                                </label>
                            </div>
                            </form>
                            <div class="first-block formulario">
                                <input onchange="editar(event)" type="text" value="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-codigopostal', true) ?>" name="inmueble-codigopostal" class="question" placeholder="" id="cod" required autocomplete="off" />
                                <label for="cod">
                                    <span>Codigo Postal</span>
                                </label>
                            </div>
                        </div>
                        <div class="descripcion">
                            <h2>Descripción:</h2>
                            <hr />
                            <form>
                                <div class="sec-block formulario">
                                    <textarea onchange="editar(event)" name="inmueble-comentarios" rows="2" class="question" placeholder="" id="msg" required autocomplete="off"><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-comentarios', true) ?></textarea>
                                    <label for="msg">
                                        <span>Describa su Inmueble:</span>
                                    </label>
                                </div>
                            </form>
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
                    <form action="/file-upload?action=upload-photo-inmueble&inmueble_id=<?php echo $inmueble->ID ?>" class="dropzone" id="dropzone"></form>
                </div>
                <div class="fotos">
                    <div class="card-scroller">

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
    </div>
</main><!-- #main -->
<script src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/ext/dropzone.min.js'; ?>"></script>

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


    function editar(e) {
        var input = e.currentTarget;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/inmueble-xhr?action=update_metadata&inmueble_id=<?php echo $inmueble->ID ?>");

        var formData = new FormData();

        formData.append('metaname', input.getAttribute("name"));
        formData.append('metavalue', input.value);


        xhr.onload = function() {
            input.style.filter = "none";
            input.removeAttribute("readonly");

        }.bind(input);
        xhr.send(formData);
        input.style.filter = "blur(1px)";
        input.setAttribute("readonly", "true");
    }

</script>

<script>
  var choicesObjs = document.querySelectorAll('.js-choice');
  var choices = [];
  for (var i = 0; i < choicesObjs.length; i++) {
    choices.push(new Choices(choicesObjs[i], {
      itemSelectText: 'Click para seleccionar',
      searchEnabled: false
    }));
  }
</script>

<script>
    moment.locale("es");
    var fechaNacimiento = "<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-owner-birth-date', true) ?>";
    document.querySelector("#fecha-nacimiento").textContent = moment(fechaNacimiento).format('D MMMM YYYY');
</script>
<?php
get_footer();
