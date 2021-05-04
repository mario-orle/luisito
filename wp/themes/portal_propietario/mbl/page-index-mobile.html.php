<?php
/**
 * Template Name: page-index-mobile.html
 * The template for displaying index-mobile.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

function myCss() {
    echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/index-mobile.css">';
}
add_action('wp_head', 'myCss');


get_header();

if (!current_user_can("administrator")) {
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="btn citas">
            <button>
                <a href="citas.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                </a>
                <div class="btn-text"><a href="citas.html">
                        <h2>Citas pendientes</h2>
                        <p>7 Documentos</p>
                    </a>

                </div>
                <div class="btn pendientes">
                </div>
            </button><button>
                <a href="doc-mobile.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
                </a>
                <div class="btn-text"><a href="doc-mobile.html">
                        <h2>Doc Pendientes</h2>
                        <p>7 Documentos</p>
                    </a>

                </div>
                <div class="btn chat">
                </div>
            </button><button>
                <a href="chat-mobile.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
                </a>
                <div class="btn-text"><a href="chat-mobile.html">
                        <h2>Mensajes sin leer</h2>
                        <p>2 Mensajes</p>
                    </a>

                </div>
                <div class="btn ofertas">
                </div>
            </button><button>
                <a href="ofertas.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>etiquetas-de-precio.png" width="100%">
                </a>
                <div class="btn-text"><a href="ofertas.html">
                        <h2>Ofertas Recibidas</h2>
                        <p>2 Ofertas</p>
                    </a>

                </div>
                <div class="btn inmueble">
                </div>
            </button><button>
                <a href="inmuebles-mbl.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>asequible.png" width="100%">
                </a>
                <div class="btn-text"><a href="inmuebles-mbl.html">
                        <h2>Inmuebles</h2>
                        <p>4 Inmuebles</p>
                    </a>

                </div>

            </button>
        </div>




        <script src="menu.js "></script>
    </div>
</main><!-- #main -->

<?php

} else {
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="btn citas">
            <button>
                <a href="citas-admin.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                </a>
                <div class="btn-text"><a href="citas-admin.html">
                        <h2>Citas pendientes</h2>
                        <p>7 Citas</p>
                    </a>

                </div>
                <div class="btn pendientes">
                </div>
            </button><button>
                <a href="doc-mobile-admin.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
                </a>
                <div class="btn-text"><a href="doc-mobile-admin.html">
                        <h2>Documentos</h2>
                        <p>7 Documentos</p>
                    </a>

                </div>
                <div class="btn chat">
                </div>
            </button><button>
                <a href="chat-mobile-admin.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
                </a>
                <div class="btn-text"><a href="chat-mobile-admin.html">
                        <h2>Mensajes</h2>
                        <p>2 Mensajes</p>
                    </a>

                </div>
                <div class="btn ofertas">
                </div>
            </button><button>
                <a href="ofertas-admin-mbl.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>etiquetas-de-precio.png" width="100%">
                </a>
                <div class="btn-text"><a href="ofertas-admin-mbl.html">
                        <h2>Ofertas</h2>
                        <p>2 Ofertas</p>
                    </a>

                </div>
                <div class="btn usuarios">
                </div>
            </button><button>
                <a href="usuario-admin-mbl.html">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" width="100%">
                </a>
                <div class="btn-text"><a href="usuario-admin-mbl.html">
                        <h2>Usuarios</h2>
                        <p>15 usuarios</p>
                    </a>

                </div>


            </button>
        </div>

    </main>



<?php
}