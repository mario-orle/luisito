<?php
/**
 * Template Name: page-perfil.html
 * The template for displaying perfil.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/perfil.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <form id="regForm" action="perfil2.html">
            <h1>Registro:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">Nombre:
                <p><input placeholder="Nombre..." oninput="this.className = ''" name="nombre"></p>
                <p><input placeholder="Primer Apellido..." oninput="this.className = ''" name="1 apellidos"></p>
                <p><input placeholder="Segundo Apellido..." oninput="this.className = ''" name="2 apellidos"></p>
            </div>
            <div class="tab">Contacto:
                <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
                <p><input placeholder="Telefono..." oninput="this.className = ''" name="telefono"></p>
            </div>
            <div class="tab">Fecha de Nacimiento:
                <p><input placeholder="Dia" oninput="this.className = ''" name="dia"></p>
                <p><input placeholder="Mes" oninput="this.className = ''" name="mes"></p>
                <p><input placeholder="Año" oninput="this.className = ''" name="año"></p>
            </div>
            <div class="tab">Localización Inmueble:
                <p><input placeholder="Provincia..." oninput="this.className = ''" name="provincia"></p>
                <p><input placeholder="Municipio..." oninput="this.className = ''" name="municipio"></p>
                <p><input placeholder="Población..." oninput="this.className = ''" name="poblacion"></p>
                <p><input placeholder="Dirección..." oninput="this.className = ''" name="direccion"></p>
                <p><input placeholder="Codigo postal..." oninput="this.className = ''" name="codigo postal"></p>
                <p><input placeholder="Numero..." oninput="this.className = ''" name="numero"></p>
                <p><input placeholder="Escalera..." oninput="this.className = ''" name="escalera"></p>
                <p><input placeholder="Puerta..." oninput="this.className = ''" name="puerta"></p>
            </div>
            <div class="tab">Superficie inmueble:
                <p><input placeholder="Metros2 Construidos..." oninput="this.className = ''" name="m2 construidos"></p>
                <p><input placeholder="Metros2 Utiles..." oninput="this.className = ''" name="m2 utiles"></p>
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