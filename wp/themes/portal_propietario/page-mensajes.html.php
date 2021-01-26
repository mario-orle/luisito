<?php
/**
 * Template Name: page-mensajes.html
 * The template for displaying mensajes.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/mensajes.css">';
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="iframe">
            <iframe src="white_chat.html"></iframe>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();