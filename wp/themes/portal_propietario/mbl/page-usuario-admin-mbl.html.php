<?php
/**
 * Template Name: page-usuario-admin-mbl.html
 * The template for displaying usuario-admin-mbl.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/usuario-admin-mbl.css">';
    echo '<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>';
}
add_action('wp_head', 'myCss');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can('administrator')) {
    $usuario = $_POST["usuario"];
    $asesor = $_POST["nuevoasesor"];
    update_user_meta($usuario, 'meta-gestor-asignado', $asesor);
}


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="inm-mbl">
            <h2>Gestión Usuarios <i class="fas fa-users"></i></h2>
            <hr>


            <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user_of_admin) {
    if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
        $asesor = get_user_by('id', get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true));
        $inmuebles = get_posts([
            'post_type' => 'inmueble',
            'post_status' => 'publish',
            'numberposts' => -1,
            'author' => $user_of_admin->ID
            // 'order'    => 'ASC'
        ]);
        $doc_ok = true;
        if (get_user_meta($user_of_admin->ID, 'meta-documento-solicitado-al-cliente')) {
            foreach (get_user_meta($user_of_admin->ID, 'meta-documento-solicitado-al-cliente') as $meta) {
                $documento = json_decode(wp_unslash($meta), true);
                if (wp_unslash($documento["status"]) != 'fichero-anadido') {
                    $doc_ok = false;
                }
            }
        }

?>

            <div class="espacio-caja">
                <button type="button" class="collapsible"><?php echo $user_of_admin->display_name; ?></button>
                <div class="content">
                    <table>

                        <tbody>
                            <tr>
                                <th>Inmuebles</th>
                                <td><?php echo count($inmuebles); ?></td>
                            </tr>
                            <tr>
                                <th>Documentación:</th>
                                <td><?php if ($doc_ok) {echo "Completa";} else {echo "Incompleta";} ?></td>
                            </tr>
<?php 
if (get_current_user_id() === 1) {
?>
                            <tr>
                                <th>Asesor:</th>
                                <td><?php echo $asesor->display_name ?></td>
                            </tr>
<?php
}
?>
                            
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar sale la documentacion del cliente -->
                        <a id="documentacion" href="doc-mobile.html"><i class="far fa-address-card"></i></a>
                        <!-- popup al pulsar ve listado inmuebles del cliente -->
                        <a id="inmuebles" href="inmuebles-mbl.html"><i class="fas fa-home"></i></a>
                        <!-- pop up cambio de usuario a otro asesor -->
<?php 
if (get_current_user_id() === 1) {
?>
                        <a id="cambio-asesor" onclick="changeAsesorOfUser(<?php echo $user_of_admin->ID; ?>)"><i class="fas fa-random"></i></a>
<?php
}
?>
                        <!-- pop up listado inmubles con listado de usuario mas precio de oferta -->
                        <a id="oferta" href="#"><i class="fas fa-dollar-sign"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
<?php

    }
}
?>
        </div>

        <br>
        <div class="pop-asesor" id="pop-asesor">
            <form method="POST">
                <label for="usuario">Selecione Asesor</label>
                <input type="hidden" name="usuario">
                <select name="nuevoasesor" id="nuevoasesor">
<?php
foreach (get_users(array('role__in' => array( 'administrator' ))) as $user) {
?>
                                <option value="<?php echo $user->ID ?>"><?php echo $user->display_name ?></option>
<?php
}
?>
                </select>
                <input type="submit" value="Submit">
            </form>
        </div>
        <br>
        <div class="pop-oferta" id="pop-oferta">
            <form>
                <label for="usuario">Selecione Inmueble</label>
                <select name="usuario" id="usuarios">
                    <option value="home">Inmueble 1</option>
                    <option value="home">Inmueble 2</option>
                    <option value="home">Inmueble 3</option>
                    <option value="home">Inmueble 4</option>
                </select>
                <br>
                <label for="oferta">Ingrese Cantidad</label>
                <input type="text" name="oferta" id="oferta" placeholder="Precio">
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
        <br>

    </div>


    <script>

MicroModal.init();

function changeAsesorOfUser(userId) {
    document.querySelector(".pop-asesor").querySelector("[name='usuario']").value = userId;
    MicroModal.show("pop-asesor");
}
    </script>
</main><!-- #main -->

<?php
get_footer();