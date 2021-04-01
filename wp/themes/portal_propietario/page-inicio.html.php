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
if ( ! function_exists( 'getAllUsersForAdmin' ) ) require_once( get_template_directory() . '/self/users-stuff.php' );


get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (!current_user_can('administrator')){
      $unread_msgs = 0;
      foreach (get_user_meta(get_current_user_id(), 'meta-messages-chat') as $chat_str) {
        $chat = json_decode(wp_unslash($chat_str), true);
        if (!$chat['readed'] && $chat["user"] == "admin") {
          $unread_msgs++;
        }
      }
      function get_own_documentos_solicitados() {
        $arr = array();
        foreach (get_user_meta(get_current_user_id(), 'meta-documento-solicitado-al-cliente') as $meta) {
            $arr[] = json_decode(wp_unslash($meta), true);
        }
        return $arr;
      }
      function get_own_citas() {
        return get_user_meta(get_current_user_id(), 'meta-citas-usuario');
      }
      
      $pending_documents = 0;
      $array_documentos = get_own_documentos_solicitados();
      foreach ($array_documentos as $i => $documento) {
        if (wp_unslash($documento["status"]) != 'fichero-anadido') {
          $pending_documents++;
        }
      }

      $pending_citas = 0;
      $array_citas = get_own_citas();

      foreach ($array_citas as $i => $cita) {
        if (wp_unslash($cita["status"]) == 'creada' || wp_unslash($cita["status"]) == 'fecha-cambiada') {
          $pending_citas++;
        }
      }

      $ofertas_recibidas = 0;
      $ofertas = get_own_ofertas_recibidas();
      $ofertas_recibidas = count($ofertas);

?>
    <div class="main">
        <div class="main-container">
        <div class="texto-cabecera">
          <h2>Resumen de Actuación</h2>
          </div>
          <hr>
                <div class="estadisticas">
                    <div class="visualizaciones">
                        <button onclick="location.href='#'">
                        <a href="#">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>lupa.png" width="100%">
                        <h2>Ofertas Recibidas</h2>
                        <p><?php echo $ofertas_recibidas ?> Ofertas</p>
                        </a>
                        </button>
                    </div>
                    <div class="contacto-email">
                        <button onclick="location.href='/mensajes'">
                        <a href="/mensajes">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>email2.png" width="100%">
                        <h2>Mensajes sin Leer</h2>
                        <p><?php echo $unread_msgs ?> Mensajes Sin Leer</p>
                        </a>
                        </button>
                    </div>
                    <div class="calendario">
                        <button onclick="location.href='/citas'">
                        <a href="/citas">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                        <h2>Citas por Confirmar</h2>
                        <p><?php echo $pending_citas ?> Citas sin Confirmar</p>
                        </a>
                        </button>
                    </div>
                    <div class="citas">
                        <button onclick="location.href='/mis-documentos'">
                        <a href="/mis-documentos">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" width="100%">
                        <h2>Doc Requeridos</h2>
                        <p><?php echo $pending_documents ?> Doc Requeridos</p>
                        </a>
                        </button>
                    </div>
                </div>
            </div>

        <div class="main-container-sub">
            <h2>Evolución de la Vivienda</h2>

            <hr>
            <div class="estadisticas-sub">
                <div class="precio-medio">
                    <p>Precio Medio de Venta en la Zona</p>
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>grafica.png" width="100%">
                </div>
                       <div class="main-up-inmuebles">
<?php 
    $inmuebles_of_user = getInmueblesOfUser(wp_get_current_user());
    foreach($inmuebles_of_user as $inmueble) {
?>
                            <div class="card-wrapper">
                             <button>
                                <a href="perfil-inmueble.html">
                                <img src="<?php echo get_post_meta($inmueble->ID, 'meta-inmueble-foto-principal', true); ?>" alt="Avatar" style="width:100%">
                                <div class="box-text">
                                  <h3><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-destino', true); ?> <i class="fas fa-edit"></i> <i class="fas fa-ban"></i></h3>
                                  <h4><b><?php echo get_post_meta($inmueble->ID, 'meta-inmueble-precioestimado', true); ?></b></h4>
                                  <p>Casa moderna con piscina, zona ajardina, garaje con 3 plazas.</p>
                                </div>
                               </a>
                              </button>
                            </div>
<?php
    }

?>
                     </div>
              </div>
        </div>
    </div>

<?php
    } else {
      $users_of_admin = get_users(array(
        'meta_key' => 'meta-gestor-asignado',
        'meta_value' => get_current_user_id()
      ));
      $unread_msgs = 0;
      $pending_documents = 0;
      $review_documents = 0;
      $pending_citas = 0;
      foreach ($users_of_admin as $user_of_admin) {
        foreach (get_user_meta($user_of_admin->ID, 'meta-messages-chat') as $chat_str) {
          $chat = json_decode(wp_unslash($chat_str), true);
          if (!$chat['readed'] && $chat["user"] == "user") {
            $unread_msgs++;
          }
        }

        foreach (get_user_meta($user_of_admin->ID, 'meta-documento-solicitado-al-cliente') as $meta) {
          $documento = json_decode(wp_unslash($meta), true);

          if (wp_unslash($documento["status"]) != 'fichero-anadido') {
            $pending_documents++;
          } else {
            $review_documents++;
          }
        }

        foreach (get_user_meta($user_of_admin->ID, 'meta-citas-usuario') as $meta) {
          $cita = json_decode(wp_unslash($meta), true);
          if (strtotime(wp_unslash($cita["fin"])) < time()) {
            if (wp_unslash($cita["status"]) == 'creada' || wp_unslash($cita["status"]) == 'fecha-cambiada') {
              $pending_citas++;
            }
          }
        }
      }
?>
   <div class="main">
   <div class="main-container">
   <div class="texto-cabecera">
          <h2>Resumen de Actuación</h2>
          </div>
          <hr>
        <div class="general">
          <div class="doc-pendientes">
            <button onclick="location.href='/admin-doc'">
              <a href="/admin-doc">
              <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
              <h2>Doc Pendientes</h2>
              <p><?php echo $pending_documents ?> Documentos</p>
              </a>
            </button>
          </div>
          <div class="doc-revisar">
            <button onclick="location.href='/admin-doc'">
              <a href="/admin-doc">
              <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>/docs.png" width="100%">
              <h2>Doc Revisar</h2>
              <p><?php echo $review_documents ?> Documentos</p>
              </a>
            </button>
          </div>
          <div class="chat-pendientes">
            <button onclick="location.href='/mensajes'">
              <a href="/mensajes">
              <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>/email2.png" width="100%">
              <h2>Chat Pendientes</h2>
              <p><?php echo $unread_msgs ?> Mensajes sin leer</p>
              </a>
            </button>
          </div>
          <div class="citas">
            <button onclick="location.href='/citas'">
              <a href="/citas">
              <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>/cita.png" width="100%">
              <h2>Citas Sin Actualizar</h2>
              <p><?php echo $pending_citas ?> Citas pendientes</p>
              </a>
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