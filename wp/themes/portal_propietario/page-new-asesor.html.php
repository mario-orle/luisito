<?php
/**
 * Template Name: page-new-asesor.html
 * The template for displaying new-asesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/new-asesor.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <form id="regForm" action="perfil2.html">
            <h1>Perfil:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">Identificación Asesor:
                <p><input placeholder="Nombre y Apellidos..." oninput="this.className = ''" name="nombre"></p>
                <p><input placeholder="Usuario..." oninput="this.className = ''" name="Usuario"></p>
                <p><input placeholder="E-mail..." oninput="this.className = ''" name="Email"></p>
                <p><input placeholder="Contraseña..." oninput="this.className = ''" name="Contraseña"></p>
            </div>

            <div class="tab">Información del Asesor:
                <p><input placeholder="Puesto..." oninput="this.className = ''" name="Puesto"></p>
                <p><input placeholder="Telefono..." oninput="this.className = ''" name="Telefono"></p>
                <p><input placeholder="Disponibilidad Horaria..." oninput="this.className = ''" name="Disponibilidad"></p>
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
            </div>
        </form>
    </div>
    <script src="<?php echo get_bloginfo('stylesheet_directory').'/assets/js/perfil.js'; ?>"></script>

</main><!-- #main -->

<?php
get_footer();