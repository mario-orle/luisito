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
        <div class="style-box">
            <table class="default">
                <tbody>
                    <tr>
                        <th>Usuario </th>
                        <th>E-mail </th>
                        <th>Dirección </th>
                        <th>Estado Documentación </th>
                        <th>Gestionar</th>
                    </tr>
                    <?php
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user_of_admin) {
    if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id()) {
                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td><?php echo $user_of_admin->user_email; ?></td>
                        <td>C/Pescadores</td>
                        <td>
                            <input type="checkbox" id="test1">
                            <label for="test1"></label>
                        </td>
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