<?php
/**
 * Template Name: page-ofertas.html
 * The template for displaying ofertas.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once __DIR__ . "/../self/security.php";

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/ofertas.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="ofertas-recibidas">
            <h2>Ofertas Realizadas <i class="fas fa-house-user"></i></h2>
            <hr>

<?php

$ofertas = [];
foreach (get_users(array('role__in' => array( 'subscriber' ))) as $user_of_admin) {
    if (get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true) == get_current_user_id() || get_current_user_id() === 1) {
        $asesor = get_user_by('id', get_user_meta($user_of_admin->ID, 'meta-gestor-asignado', true));
        $inmuebles_del_cliente = getInmueblesOfUser($user_of_admin);
        foreach ($inmuebles_del_cliente as $inmueble) {
            $ofertas_del_inmueble = get_post_meta($inmueble->ID, 'meta-oferta-al-cliente');
            foreach ($ofertas_del_inmueble as $key => $oferta) {
                $oferta = json_decode(wp_unslash($oferta), true);
                $ofertas[] = $oferta;
?>
            <div class="espacio-caja">
                <button type="button" class="collapsible">OFERTA</button>
                <div class="content">
                    <table>
                        <tbody>
                            <tr>
                                <th>Nombre:</th>
                                <td><?php echo $user_of_admin->display_name; ?></td>
                            </tr>
                            <tr>
                                <th>Dirección:</th>
                                <td><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true); ?></td>
                            </tr>
                            <tr>
                                <th>Oferta:</th>
                                <td><?php echo number_format($oferta["cantidad"], 0, ',', '.'); ?> €</td>
                            </tr>
                            <tr>
                                <th>Cita:</th>
                                <td><?php echo $oferta["cita"]?></td>
                            </tr>
                            <tr>
                                <th>Hora:</th>
                                <td><?php echo date_format(new DateTime($oferta['cita']), 'H:i')?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="funciones">
                        <!-- popup al pulsar el checke mostando las opciones aceptar denegar o contraoferta -->
                        <a id="edit-oferta" href="#"><i class="fas fa-money-check-alt"></i></a>
                        <!-- popup calendario para modificar feche de cita -->
                        <a id="edit-cita" href="#"><i class="fas fa-calendar-alt"></i></a>
                        <!-- eliminar es eliminar xD -->
                        <a id="eliminar" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>

<?php
            }
        }
    }
}
?>

        </div>
    </div>

    <script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
    </script>
</main><!-- #main -->

<?php
get_footer();