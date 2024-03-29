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

require_once __DIR__ . "/../self/security.php";

get_header();

if (!current_user_can("administrator")) {
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
      $cita = json_decode(wp_unslash($cita), true);
      if (wp_unslash($cita["status"]) != 'aceptada-cliente' && wp_unslash($cita["status"]) != 'rechazada-cliente' && wp_unslash($cita["status"]) != 'realizada' && wp_unslash($cita["status"]) != 'descartada') {
        $pending_citas++;
      }
    }

    $ofertas_recibidas = 0;
    $ofertas = get_own_ofertas_recibidas(wp_get_current_user());
    foreach ($ofertas as $user => $ofertas_arr) {
      $ofertas_recibidas += count($ofertas_arr);
    }

    $inmuebles = get_posts(array(
        'post_type' => 'inmueble',
        'author' => get_current_user_id(),
        'nopaging' => true
    ));
    $count_inmuebles = count($inmuebles);
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="btn citas">
            <button>
                <a href="/citas-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                </a>
                <div class="btn-text"><a href="/citas-mbl">
                        <h2>Citas</h2>
                        <p><span id="pending_citas"><?php echo $pending_citas; ?></span> citas</p>
                    </a>

                </div>
            </button>
            <button>
            <a id="mensajes" href="https://wa.me/34<?php echo get_user_meta($asesor_id, 'meta-phone', true); ?>" target="_blank">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>whatsapp.png">
          </a>
                <div class="btn-text"><a href="https://wa.me/34<?php echo get_user_meta($asesor_id, 'meta-phone', true); ?>" target="_blank">
                        <h2>Chat</h2>
                    </a>

                </div>
    
            </button><button>
                <a href="/servicios-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>notario.png" width="100%">
                </a>
                <div class="btn-text"><a href="/servicios-mbl">
                        <h2>Servicios +</h2>
                    </a>
                </div>
            </button><button>
                <a href="/doc-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
                </a>
                <div class="btn-text"><a href="/doc-mbl">
                        <h2>Documentos</h2>
                        <p><span id="pending_documents"><?php echo $pending_documents ?></span> Documentos</p>
                    </a>

                </div>
  
            </button><button>
                <a href="/ofertas-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>etiquetas-de-precio.png" width="100%">
                </a>
                <div class="btn-text"><a href="/ofertas-mbl">
                        <h2>Ofertas</h2>
                        <p><span id="ofertas_recibidas"><?php echo $ofertas_recibidas ?></span> Ofertas</p>
                    </a>

                </div>
              
            </button><button>
                <a href="/inmuebles-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>asequible.png" width="100%">
                </a>
                <div class="btn-text"><a href="/inmuebles-mbl">
                        <h2>Inmuebles</h2>
                        <p><?php echo $count_inmuebles ?> Inmuebles</p>
                    </a>

                </div>

            </button>
        </div>




        <script src="menu.js "></script>
    </div>
</main><!-- #main -->

<?php

} else {
  if (get_current_user_id() === 1) {
    $users_of_admin = get_users(array(
      "role" => "subscriber", 'nopaging' => true
    ));
  } else {
    $users_of_admin = get_users(array(
      'meta_key' => 'meta-gestor-asignado',
      'meta_value' => get_current_user_id(), 'nopaging' => true
    ));
  }
  $unread_msgs = 0;
  $pending_documents = 0;
  $review_documents = 0;
  $num_documents = 0;
  $pending_citas = 0;   
  $servicios = [];
  $total_servicios = 0;

  $ofertas_recibidas = 0;
  $ofertas = get_all_ofertas();
  $ofertas_recibidas = count($ofertas);

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
        if (!($documento["revisado"]) ) {

          $review_documents++;
        }
      }

      $num_documents++;
    }

    foreach (get_user_meta($user_of_admin->ID, 'meta-citas-usuario') as $meta) {
      $cita = json_decode(wp_unslash($meta), true);
      if (strtotime(wp_unslash($cita["fin"])) < time()) {
        if (wp_unslash($cita["status"]) == 'creada' || wp_unslash($cita["status"]) == 'fecha-cambiada') {
          $pending_citas++;
        }
      }
    }
    $servicio_notario = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-notario', true);
    $servicio_certificado = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-certificado-energetico', true);
    $servicio_nota_simple = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-nota-simple', true);
    $servicio_reportaje = get_user_meta($user_of_admin->ID, 'meta-servicio-plus-reportaje-fotografico', true);

    if ($servicio_notario === "solicitado" || $servicio_notario === "leido") {
      $total_servicios++;
    }
    if ($servicio_certificado === "solicitado" || $servicio_certificado === "leido") {
      $total_servicios++;
    }
    if ($servicio_nota_simple === "solicitado" || $servicio_nota_simple === "leido") {
      $total_servicios++;
    }
    if ($servicio_reportaje === "solicitado" || $servicio_reportaje === "leido") {
      $total_servicios++;
    }
  }
?>

<main id="primary" class="site-main">
    <div class="main">
        <div class="btn citas">
            <button>
                <a href="/citas-admin-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>schedule.png" width="100%">
                </a>
                <div class="btn-text"><a href="/citas-admin-mbl">
                        <h2>Citas</h2>
                        <p><span id="pending_citas"><?php echo $pending_citas ?></span> Citas</p>
                    </a>

                </div>
                <div class="btn pendientes">
                </div>
            </button><button>
                <a href="/doc-mbl-admin">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>docs.png" width="100%">
                </a>
                <div class="btn-text"><a href="/doc-mbl-admin">
                        <h2>Documentos</h2>
                        <p><span id="pending_documents"><?php echo $pending_documents ?></span> Documentos</p>
                    </a>

                </div>
                <div class="btn chat">
                </div>
            </button><button>                 
              <a href="/admin-alertas-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>notario.png" width="100%">
                </a>
                <div class="btn-text"><a href="/admin-alertas-mbl">
                        <h2>Servicios +</h2>
                        <p><span id="total_servicios"><?php echo $total_servicios ?></span> Alertas</p>
                    </a>
                </div>
                <div class="btn ofertas">
                </div>
            </button><button>
                <a href="/ofertas-admin-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>etiquetas-de-precio.png" width="100%">
                </a>
                <div class="btn-text"><a href="/ofertas-admin-mbl">
                        <h2>Ofertas</h2>
                        <p><span id="ofertas_recibidas"><?php echo $ofertas_recibidas ?></span> Ofertas</p>
                    </a>

                </div>
                <div class="btn usuarios">
                </div>
            </button><button>
                <a href="/usuarios-mbl">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/'?>perfil.png" width="100%">
                </a>
                <div class="btn-text"><a href="/usuarios-mbl">
                        <h2>Propietarios</h2>
                        <p><span id="num_usuarios"><?php echo count($users_of_admin) ?></span> propietarios</p>
                    </a>

                </div>


            </button>
            
        </div>

    </main>



<?php
}
?>

<script>
  function update() {
    fetch('/usuarios-xhr?action=inicio_data').then(res => res.json()).then(res => {
      Object.keys(res).map(id => {
        if (document.querySelector("#" + id)) {
          document.querySelector("#" + id).innerHTML = res[id];
        }
      });

      /*if (res.unread_msgs > 0) {
        document.querySelector('.mensajes-wrapper').classList.add('unread');
      } else {
        document.querySelector('.mensajes-wrapper').classList.remove('unread');

      }*/

      setTimeout(() => {
        update();
      }, 10000);
    });
  }
  update();
</script>
<?php