<?php
/**
 * Template Name: page-admin-alertas.html
 * The template for displaying admin-alertas.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/popup.css?cb=' . generate_random_string() . '">';
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/usuarios-admin.css">';
    echo '<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">';
    echo '<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>';
    echo '<script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>';

}
add_action('wp_head', 'myCss');

if (get_current_user_id() === 1) {
    $users_of_admin = get_users(array(
        "role" => "subscriber"
    ));
} else {
    $users_of_admin = get_users(array(
        'meta_key' => 'meta-gestor-asignado',
        'meta_value' => get_current_user_id()
    ));
}


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="style-box">
            <table class="default">
                <thead>
                    <tr>
                        <th>Nombre </th>
                        <th>Servicio</th>
                        <th>Gestionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
foreach ($users_of_admin as $user_of_admin) {
    $servicio_notario = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-notario', true);
    $servicio_certificado = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-certificado-energetico', true);
    $servicio_nota_simple = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-nota-simple', true);
    $servicio_reportaje = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-reportaje-fotografico', true);
    if ($servicio_notario === 'solicitado' || $servicio_notario === 'leido') {

                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td>Notario</td>
                        <td>
                            <a id="editar" href="#" onclick="lee(<?= $user_of_admin->ID ?>, 'meta-servicio-plus-notario')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <?php
    }
    if ($servicio_certificado === 'solicitado' || $servicio_certificado === 'leido') {

                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td>Certificado Energético</td>
                        <td>
                            <a id="editar" href="#" onclick="lee(<?= $user_of_admin->ID ?>, 'meta-servicio-plus-certificado-energetico')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <?php
    }
    if ($servicio_nota_simple === 'solicitado' || $servicio_nota_simple === 'leido') {

                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td>Nota simple</td>
                        <td>
                            <a id="editar" href="#" onclick="lee(<?= $user_of_admin->ID ?>, 'meta-servicio-plus-nota-simple')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <?php
    }
    if ($servicio_reportaje === 'solicitado' || $servicio_reportaje === 'leido') {

                    ?>
                    <tr>
                        <td><?php echo $user_of_admin->display_name; ?></td>
                        <td>Reportaje fotográfico</td>
                        <td>
                            <a id="editar" href="#" onclick="lee(<?= $user_of_admin->ID ?>, 'meta-servicio-plus-reportaje-fotografico')"><i class="fas fa-trash"></i></a>
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
    <script>

function lee(userId, meta) {
    if (!confirm('Se descartará la notificación. ¿Está seguro?')) return;
    fetch("/usuarios-xhr?action=read-servicio&user_id=" + userId + "&usermeta=" + meta)
        .then(res => window.location.reload())

}

const dataTable = new simpleDatatables.DataTable("table", {
    labels: {
        placeholder: "Buscar...",
        perPage: " elementos por página",
        noRows: "Sin elementos para mostrar",
        info: "Mostrando {start} a {end} de {rows} elementos (Pág {page} de {pages})",
    },

});
    </script>
</main><!-- #main -->

<?php
get_footer();