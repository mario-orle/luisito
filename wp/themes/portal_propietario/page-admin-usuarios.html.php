<?php
/**
 * Template Name: page-usuarios-admin.html
 * The template for displaying usuarios-admin.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/usuarios-admin.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
    <div class="agregar-wrapper">
        <div class="card-agregar">
          <button>
            <a href="/perfil">
              <div class="img-agregar">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>plus.png" alt="" style="width:10%">
                <h3><b>AGREGAR USUARIO</b></h3>
              </div>
            </a>
          </button>
        </div>
      </div>
        <div class="style-box">
            <table class="default">
                <tbody>
                    <tr>
                        <th>Usuario </th>
                        <th>E-mail </th>
                        <th>Nº Inmuebles </th>
                        <th>Estado Documentación </th>
<?php 
if (get_current_user_id() === 1) {
?>
                        <th>Asesor asignado</th>
<?php
}
?>
                        <th>Gestionar</th>
                    </tr>
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
                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td><?php echo $user_of_admin->user_email; ?></td>
                        <td><?php echo count($inmuebles); ?></td>
                        <td>
                            <input type="checkbox" id="test<?php echo $user_of_admin->ID ?>">
                            <label for="test<?php echo $user_of_admin->ID ?>"></label>
                        </td>
                        <?php 
if (get_current_user_id() === 1) {
?>
                        <td><?php echo $asesor->display_name ?></td>
<?php
}
?>
                        <td>
                            <a id="Archivo" href="/perfil?user=<?php echo $user_of_admin->ID ?>"><i class="fas fa-folder"></i></a>
                            <a id="editar" href="/perfil?user=<?php echo $user_of_admin->ID ?>"><i class="fas fa-edit"></i></a>
                            <a id="chat" href="/mensajes?user=<?php echo $user_of_admin->ID ?>"><i class="fas fa-comments"></i></a>
                        </td>
                    </tr>

                    <?php

    }
}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();