<?php
/**
 * Template Name: page-inmuebles.html
 * The template for displaying inmuebles.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/inmuebles.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="main-up-inmuebles">
            <div class="card-wrapper">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>casa1.jpg" alt="Avatar" style="width:100%">
                    <div class="editar-tirar">

                    </div>
                    <div class="container">
                        <h4><b>SE VENDE</b> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                        <p>145.000€</p>
                        <p>Casa en zonal rural, gran jardin, perfecto para criar a sus hijos</p>
                    </div>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>casa2.jpg" alt="Avatar" style="width:100%">
                    <div class="editar-tirar">

                    </div>
                    <div class="container">
                        <h4><b>SE ALQUILA</b> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                        <p>145.000€</p>
                        <p>Casa moderna con piscina, zona ajardina, garaje con 3 plazas.</p>
                    </div>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>casa3.jpg" alt="Avatar" style="width:100%">
                    <div class="editar-tirar">

                    </div>
                    <div class="container">
                        <h4><b>SE VENDE</b> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                        <p>205.000€</p>
                        <p>Casa en zonal rural, gran jardin, perfecto para criar a sus hijos</p>
                    </div>
                </div>
            </div>

            <div class="card-wrapper">
                <div class="card">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>casa4.jpg" alt="Avatar" style="width:100%">
                    <div class="editar-tirar">

                    </div>
                    <div class="container">
                        <h4><b>SE ALQUILA</b> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h4>
                        <p>5.000.000€</p>
                        <p>Casa en zonal rural, gran jardin, perfecto para criar a sus hijos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();