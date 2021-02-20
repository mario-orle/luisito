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
            <a href="/new-asesor">
              <div class="img-agregar">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>plus.png" alt="" style="width:10%">
                <h3><b>AGREGAR ASESOR</b></h3>
              </div>
            </a>
          </button>
        </div>
      </div>
        <div class="style-box">
            <table class="default">
                <tbody>
                    <tr>
                        <th>Asesor </th>
                        <th>E-mail </th>
                        <th>Disponibilidad</th>
                        <th>Número de clientes </th>
                        <th>Gestionar</th>
                    </tr>
                    <?php
foreach (get_users(array('role__in' => array( 'administrator' ))) as $user_admin) {
    $users_of_admin = get_users(array(
        'meta_key' => 'meta-gestor-asignado',
        'meta_value' => $user_admin->ID
    ));
                    ?>
                    <tr>
                        <td><?php echo $user_admin->display_name; ?></td>
                        <td><?php echo $user_admin->user_email; ?></td>
                        <td><?php echo get_user_meta($user_admin->ID, 'meta-disponibilidad', true) ?></td>
                        <td><?php echo count($users_of_admin); ?></td>
                        <td>
                            <a id="editar" href="/perfiladmin?user=<?php echo $user_admin->ID ?>"><i class="fas fa-key"></i></a>
                        </td>
                    </tr>

                    <?php

}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();