<?php
/**
 * Template Name: page-admin-asesor.html
 * The template for displaying admin-asesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/gestiones-adminasesor.css">';
}
add_action('wp_head', 'myCss');

$user = wp_get_current_user();
$creator_of_user = get_user_meta($user->ID, 'meta-creator-of-user', true);
//si ha sido creado por otro usuario, al inicio
if (empty($creator_of_user) && !empty($_GET['user']) ) {
    $user = get_user_by('ID', $_GET['user']);
}


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="perfil-asesor">
            <div class="asesor-admin">
                <div class="info-asesor">
                    <div class="img-asesor">
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
                    <div class="main-formulario">
                        <div class="caracteristicas">
                            <h2>Perfil Asesor:</h2>
                                <div class="first-block formulario">
                                    <input type="text" name="admin-display-name" value="<?php echo $user->display_name; ?>" class="question" placeholder="" id="nombre" required="" autocomplete="off" onchange="editar(event)">
                                    <label for="nombre">
                                        <span>Nombre y Apellidos</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input type="text" name="email" value="<?php echo $user->user_email; ?>" readonly class="question" placeholder="" id="email" required="" autocomplete="off">
                                    <label for="email">
                                        <span>E-mail</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input type="text" name="phone" value="<?php echo get_user_meta($user->ID, 'meta-phone', true) ?>" class="question" placeholder="" id="telefono" required="" autocomplete="off" onchange="editar(event)">
                                    <label for="telefono">
                                        <span>Telefono</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input type="password" name="pwd" class="question" placeholder="" id="pass" required="" autocomplete="off" onchange="editarPassword(event)">
                                    <label for="pass">
                                        <span>Contraseña</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input type="text" name="puesto" class="question" value="<?php echo get_user_meta($user->ID, 'meta-puesto', true) ?>" placeholder="" id="puesto" required="" autocomplete="off"  onchange="editar(event)">
                                    <label for="puesto">
                                        <span>Puesto</span>
                                    </label>
                                </div>
                                <div class="first-block formulario">
                                    <input type="text" name="disponibilidad" class="question" value="<?php echo get_user_meta($user->ID, 'meta-disponibilidad', true) ?>" placeholder="" id="disponibilidad" required="" autocomplete="off" onchange="editar(event)">
                                    <label for="disponibilidad">
                                        <span>Disponibilidad</span>
                                    </label>
                                </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main><!-- #main -->
<script>

function editarPassword(e) {
    if (confirm("¿Estás seguro de cambiar la contraseña de este usuario?")) {
        var input = e.currentTarget;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/usuarios-xhr?action=update_password&user_id=<?php echo $user->ID ?>");

        var formData = new FormData();

        formData.append('new-password', input.value);


        xhr.onload = function() {
            input.style.filter = "none";
            input.removeAttribute("readonly");
            
            Toastify({
                text: "Contraseña actualizada",
                duration: 3000,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                backgroundColor: "rgb(254, 152, 0)",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                onClick: function(){} // Callback after click
            }).showToast();
            input.value = "";

        }.bind(input);
        xhr.send(formData);
        input.style.filter = "blur(1px)";
        input.setAttribute("readonly", "true");
    }
}

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
            document.querySelector(".img-asesor img").src = e.target.result;
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
<?php
get_footer();