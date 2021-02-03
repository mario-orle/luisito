<?php
/**
 * Template Name: page-inicio.html
 * The template for displaying inicio.html
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";
function myCss() {
    if (current_user_can('administrator')){
        echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/inicio-admin.css?cb=' . generate_random_string() . '">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/assets/css/inicio.css?cb=' . generate_random_string() . '">';
    }
    
}
add_action('wp_head', 'myCss');


get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (!current_user_can('administrator')){
        ?>
    <div class="main">
        <div class="main-container">
            <h2>Estadisticas Generales</h2>
                <br>
                <div class="estadisticas">
                    <div class="visualizaciones">
                        <button>
                        <a href="citas-admin.html">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>lupa.png" width="100%">
                        <h2>Ofertas Recibidas</h2>
                        <p>3 Ofertas</p>
                        </a>
                        </button>
                    </div>
                    <div class="contacto-email">
                        <button>
                        <a href="#">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
                        <h2>Mensajes sin Leer</h2>
                        <p>8 Mensajes Sin Leer</p>
                        </a>
                        </button>
                    </div>
                    <div class="calendario">
                        <button>
                        <a href="#">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                        <h2>Citas por Confirmar</h2>
                        <p>3 Citas sin Confirmar</p>
                        </a>
                        </button>
                    </div>
                    <div class="citas">
                        <button>
                        <a href="citas.html">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" width="100%">
                        <h2>Doc Requeridos</h2>
                        <p>3 Doc Requeridos</p>
                        </a>
                        </button>
                    </div>
                </div>
            </div>

        <div class="main-container-sub">
            <h2>Evolución de la Vivienda</h2>

            <br>
            <div class="estadisticas-sub">
                <div class="precio-medio">
                    <p>Precio Medio de Venta en la Zona</p>
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>grafica.png" width="100%">
                </div>
                <div class="tipos-precio">
                    <div class="precio-venta">
                        <h1>150.000€ </h1>
                        <p>Precio de venta <i class="fas fa-hand-holding-usd"></i> </p>
                    </div>
                    <div class="precio-recomendado">
                        <h1>175.000€</h1>
                        <p>Precio Recomendado <i class="fas fa-hand-holding-usd"></i></p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    } else {
        ?>
   <div class="main">
      <div class="main-container">
        <h2>Resumen de Actuación</h2>
        <div class="general">
          <div class="doc-pendientes">
            <button>
              <a href="#">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
              <h2>Doc Pendientes</h2>
                <p>7 Documentos</p>
            </button>
          </div>
          <div class="doc-revisar">
            <button>
              <a href="#">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
              <h2>Doc Revisar</h2>
              <p>2 Documentos</p>
            </button>
          </div>
          <div class="chat-pendientes">
            <button>
              <a href="#">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
              <h2>Chat Pendientes</h2>
              <p>4 Mensajes sin leer</p>
            </button>
          </div>
          <div class="citas">
            <button>
              <a href="#">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
              <h2>Citas Sin Actualizar</h2>
              <p>6 Citas pendientes</p>
            </button>
          </div>
        </div>
      </div>
    </div>
        <?php 
        }
        ?>
</main><!-- #main -->

<?php
get_footer();