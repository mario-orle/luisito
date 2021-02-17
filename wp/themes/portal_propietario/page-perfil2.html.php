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

$user = wp_get_current_user();

if (current_user_can('administrator') && !empty($_GET['user'])) {
    $user = get_user_by('ID', $_GET['user']);
}

function myCss()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/perfil2.css?cb=' . generate_random_string() . '">';
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/ext/dropzone.min.css?cb=' . generate_random_string() . '">';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>';
    echo '<script src="'.get_bloginfo('stylesheet_directory').'/assets/ext/moment.min.js?cb=' . generate_random_string() . '"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/css/datepicker.min.css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/datepicker-full.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.2/dist/js/locales/es.js"></script>';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />';

}
add_action('wp_head', 'myCss');


get_header();
?>
<main id="primary" class="site-main">
    <div class="main">
        <div class="row">
            <div class="side">
                <div class="fakeimg-perfil">
                    <label for="uploader">
                        <?php 
if (get_user_meta($user->ID, 'meta-foto-perfil', true)) {
?>
                        <img data-photo-selected class="user-logo-auto" src="<?php echo get_user_meta($user->ID, 'meta-foto-perfil', true) ?>" style="width:200px;height: 200px;">
<?php
} else {
?>
                        <img class="user-logo-auto" src="<?php echo get_template_directory_uri() . '/assets/img/' ?>perfil.png" style="width:200px;height: 200px;">
<?php
}
?>                    
                    </label>
                    <input type="file" name="foto-perfil" id="uploader" style="display: none;" />
                </div>
                <hr>
                <h4 style="color:aliceblue;">Información personal </h4>
                <p>
                    <input type="text" name="owner-display-name" class="editor" value="<?php echo $user->display_name ?>" onchange="editar(event)" />
                    
                </p>
                <p id="fecha-nacimiento">
                    <input type="text" id="datepicker" class="editor">
                    <input type="hidden" name="owner-birth-date" value="<?php echo get_user_meta($user->ID, 'meta-owner-birth-date', true) ?>">
                    
                </p>
                <p id="dni">
                    <select class="js-choice" name="owner-tipodocumento" onchange="editar(event)">
                        <option <?php if (get_user_meta($user->ID, 'meta-owner-tipodocumento', true) == "DNI") { echo "selected"; } ?> value="DNI">DNI</option>
                        <option <?php if (get_user_meta($user->ID, 'meta-owner-tipodocumento', true) == "NIE") { echo "selected"; } ?> value="NIE">NIE</option>           
                    </select>
                    <input type="text" name="owner-numdocumento" class="editor" value="<?php echo get_user_meta($user->ID, 'meta-owner-numdocumento', true) ?>" onchange="editar(event)" >
                </p>
                <hr>
                <h4 style="color:aliceblue;">Contacto</h4>
                <p>Tlfn: 
                    <input type="text" name="owner-phone" class="editor" value="<?php echo get_user_meta($user->ID, 'meta-owner-phone', true) ?>" onchange="editar(event)" />
                </p>
                <p>Email: 
                    <input type="text" name="owner-email" style="width: 75%;" class="editor" value="<?php echo get_user_meta($user->ID, 'meta-owner-email', true) ?>" onchange="editar(event)" />    
                </p>
                <hr>
            </div>
            <div class="main-perfil">
                <div class="form-caracteristicas">
                    
 
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->
<script src="<?php echo get_bloginfo('stylesheet_directory') . '/assets/ext/dropzone.min.js'; ?>"></script>

<script>
    function editar(e) {
        var input = e.currentTarget;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/usuarios-xhr?action=update_metadata&user_id=<?php echo $user->ID ?>");

        var formData = new FormData();

        formData.append('metaname', input.getAttribute("name"));
        formData.append('metavalue', input.value);


        xhr.onload = function() {
            input.style.filter = "none";
            input.removeAttribute("readonly");
            
            Toastify({
                text: "Dato actualizado",
                duration: 3000,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                backgroundColor: "rgb(254, 152, 0)",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                onClick: function(){} // Callback after click
            }).showToast();

        }.bind(input);
        xhr.send(formData);
        input.style.filter = "blur(1px)";
        input.setAttribute("readonly", "true");
    }

    document.querySelector("#uploader").onchange = function () {
        var file = this.files[0];
        if (file) {

            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.querySelector(".fakeimg-perfil img").src = e.target.result;
                /*var c = new Croppie(document.querySelector(".fakeimg-perfil img"), {
                    viewport: { width: 150, height: 150, type: 'circle' },
                    boundary: { width: 200, height: 200 },
                    
                });*/

            }
            
            reader.readAsDataURL(file); // convert to base64 string

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/usuarios-xhr?action=update_photo&user_id=<?php echo $user->ID ?>");

            xhr.onload = function () {

                Toastify({
                    text: "Imagen actualizada",
                    duration: 3000,
                    gravity: "bottom", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    backgroundColor: "rgb(254, 152, 0)",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                }).showToast();
            }

            var formData = new FormData();
            formData.append("foto-perfil", file);
            xhr.send(formData);
        }
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
    var fechaNacimiento = "<?php echo get_user_meta($user->ID, 'meta-owner-birth-date', true) ?>";
    var firstTime = true;

    document.querySelector("#fecha-nacimiento input[type='text']").value = moment(fechaNacimiento).format('D MMMM YYYY');
    document.querySelector("#fecha-nacimiento input[type='hidden']").value = moment(fechaNacimiento).format();
    var elemDt = document.querySelector('input#datepicker');
    var datepicker = new Datepicker(elemDt, {
        autohide: true,
        language: 'es',
        maxDate: new Date(new Date().getFullYear() - 18, 1, 1),
        weekStart: 1,
        format: {
        toValue(date, format, locale) {
            return moment(date, 'D MMMM YYYY');;
        },
        toDisplay(date, format, locale) {
            var elem = document.querySelector('input[name="owner-birth-date"]');
            elem.value = moment(date).format();
            if (!firstTime) {
                elemDt.blur();
                editar({currentTarget: elem});
            }
            firstTime = false;

            return moment(date).format('D MMMM YYYY');
        },
        }
    }); 
</script>
<?php
get_footer();
