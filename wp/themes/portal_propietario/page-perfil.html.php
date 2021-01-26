<?php
/**
 * Template Name: page-perfil.html
 * The template for displaying perfil.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

$inmueble = get_posts(array(
    'post_type' => 'inmueble',
    'post_author' => get_current_user_id()
))[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST' || $inmueble) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$inmueble) {

        $inmueble_id = wp_insert_post(array(
            'post_type' => 'inmueble',
            'post_title' => 'inmueble-' . get_current_user_id(),
            'post_status' => 'publish'
        ));
    
        foreach ($_POST as $key => $value) {
            update_post_meta($inmueble_id, 'meta-' . $key, $value);
        }
    }
    
    require('page-perfil2.html.php');

} else {
function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <form id="regForm" method="post">
            <h1>Registro:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">Nombre:
                <p><input placeholder="Nombre..." oninput="this.className = ''" name="inmueble-owner-name"></p>
                <p><input placeholder="Primer Apellido..." oninput="this.className = ''" name="inmueble-owner-lastname"></p>
                <p><input placeholder="Segundo Apellido..." oninput="this.className = ''" name="inmueble-owner-lastname2"></p>
            </div>
            <div class="tab">Contacto:
                <p><input placeholder="E-mail..." oninput="this.className = ''" name="inmueble-owner-email"></p>
                <p><input placeholder="Telefono..." oninput="this.className = ''" name="inmueble-owner-phone"></p>
            </div>
            <div class="tab">Fecha de Nacimiento:
                <p><input placeholder="Dia" oninput="this.className = ''" name="inmueble-owner-birth-day"></p>
                <p><input placeholder="Mes" oninput="this.className = ''" name="inmueble-owner-birth-month"></p>
                <p><input placeholder="Año" oninput="this.className = ''" name="inmueble-owner-birth-year"></p>
            </div>
            <div class="tab">Localización Inmueble:
                <p><input placeholder="Provincia..." oninput="this.className = ''" name="inmueble-provincia"></p>
                <p><input placeholder="Municipio..." oninput="this.className = ''" name="inmueble-municipio"></p>
                <p><input placeholder="Población..." oninput="this.className = ''" name="inmueble-poblacion"></p>
                <p><input placeholder="Dirección..." oninput="this.className = ''" name="inmueble-direccion"></p>
                <p><input placeholder="Codigo postal..." oninput="this.className = ''" name="inmueble-codigopostal"></p>
                <p><input placeholder="Numero..." oninput="this.className = ''" name="inmueble-numero"></p>
                <p><input placeholder="Escalera..." oninput="this.className = ''" name="inmueble-escalera"></p>
                <p><input placeholder="Puerta..." oninput="this.className = ''" name="inmueble-puerta"></p>
            </div>
            <div class="tab">Características inmueble:
                <p><input placeholder="Habitaciones..." oninput="this.className = ''" name="inmueble-habitaciones"></p>
                <p><input placeholder="Metros2 Construidos..." oninput="this.className = ''" name="inmueble-m2construidos"></p>
                <p><input placeholder="Metros2 Utiles..." oninput="this.className = ''" name="inmueble-m2utiles"></p>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>
    </div>
</main><!-- #main -->
<script src="<?php echo get_bloginfo('stylesheet_directory').'/assets/js/perfil.js'; ?>"></script>
<?php
get_footer();
}