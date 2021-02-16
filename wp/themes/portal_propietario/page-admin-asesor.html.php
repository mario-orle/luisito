<?php
/**
 * Template Name: page-adminasesor.html
 * The template for displaying adminasesor.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/gestiones-adminasesor.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="perfil-asesor">
            <div class="asesor-admin">
                <div class="info-asesor">
                    <div class="img-asesor">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" style="width:100%;">
                    </div>
                    <div class="main-formulario">
                        <div class="caracteristicas">
                            <h2>Perfil Asesor:</h2>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="nombre" required="" autocomplete="off">
                                    <label for="nombre">
                                        <span>Nombre y Apellidos</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="usuario" required="" autocomplete="off">
                                    <label for="usuario">
                                        <span>Usuario</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="email" required="" autocomplete="off">
                                    <label for="email">
                                        <span>E-mail</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="telefono" required="" autocomplete="off">
                                    <label for="telefono">
                                        <span>Telefono</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="pass" required="" autocomplete="off">
                                    <label for="pass">
                                        <span>Contraseña</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="telefono" required="" autocomplete="off">
                                    <label for="telefono">
                                        <span>Puesto</span>
                                    </label>
                                </div>
                            </form>
                            <form>
                                <div class="first-block formulario">
                                    <input type="text" name="name" class="question" placeholder="" id="disponibilidad" required="" autocomplete="off">
                                    <label for="disponibilidad">
                                        <span>Disponibilidad</span>
                                    </label>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();