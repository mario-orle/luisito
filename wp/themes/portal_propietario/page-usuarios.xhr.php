<?php
/**
 * Template Name: page-usuarios.xhr.php
 * The template for displaying page-usuarios.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
require_once "self/users-stuff.php";
if ($_GET['action'] == 'check-email') {
    $email = $_GET['email'];
    echo email_exists($email);
}
if ($_GET['action'] == 'update_metadata') {
    $user_id = $_GET['user_id'];

    
    update_user_meta($user_id, 'meta-' . $_POST['metaname'], wp_slash($_POST['metavalue']));

    if ($_POST["metaname"] === 'owner-display-name' || $_POST["metaname"] === 'admin-display-name') {
        $userdata = array(
            'ID'           => $user_id,
            'display_name' => $_POST['metavalue'],
        );
        wp_update_user( $userdata );
    }
}
if ($_GET['action'] == 'update_photo') {
    $user_id = $_GET['user_id'];

    if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

    $upload_overrides = array( 'test_form' => false );
    $movefile = wp_handle_upload( $_FILES['foto-perfil'], $upload_overrides );
    
    update_user_meta($user_id, 'meta-foto-perfil', wp_slash($movefile['url']));
}

if ($_GET['action'] == 'update_password') {
    $user_id = $_GET['user_id'];
    $new_pwd = $_POST["new-password"];


    wp_set_password($new_pwd, $user_id);

    if (get_current_user_id() == $user_id) {
        $user = get_user_by('ID', $user_id);

        wp_set_auth_cookie($user->ID);
        wp_set_current_user($user->ID);
        do_action('wp_login', $user->user_login, $user);
    }

}
if ($_GET['action'] == 'delete-user') {
    require_once( ABSPATH.'wp-admin/includes/user.php' );

    $user_id = $_GET['user_id'];
    wp_delete_user($user_id);
}

if ($_GET['action'] == 'inicio_data') {
    if ( ! function_exists( 'getAllUsersForAdmin' ) ) require_once( get_template_directory() . '/self/users-stuff.php' );
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

        $citas = get_posts(array(
            'post_type' => 'cita',
            'post_status' => 'publish',
            'nopaging' => true
        ));
        foreach ($citas as $cita) {
            $user_of_cita = get_post_meta($cita->ID, 'meta-usuario-asignado', true);
            $cita_info = get_post_meta($cita->ID, 'meta-info-cita', true);
            if ($user_of_cita == get_current_user_id()) {
                $cita_encoded = json_decode(wp_unslash($cita_info), true);
                if (wp_unslash($cita_encoded["status"]) != 'realizada' && wp_unslash($cita_encoded["status"]) != 'descartada') {
                    $pending_citas++;
                }
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

        echo json_encode([
            "unread_msgs" => $unread_msgs,
            "pending_documents" => $pending_documents,
            "pending_citas" => $pending_citas,
            "inmuebles" => count($inmuebles),
            "ofertas_recibidas" => $ofertas_recibidas
        ]);
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
        $pending_citas = 0;
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
            }


            $citas = get_posts(array(
                'post_type' => 'cita',
                'post_status' => 'publish',
                'nopaging' => true
            ));
            foreach ($citas as $cita) {
                $user_of_cita = get_post_meta($cita->ID, 'meta-usuario-asignado', true);
                $cita_info = get_post_meta($cita->ID, 'meta-info-cita', true);
                if ($user_of_cita == $user_of_admin->ID) {
                    $cita_encoded = json_decode(wp_unslash($cita_info), true);
                    if (wp_unslash($cita_encoded["status"]) != 'realizada' && wp_unslash($cita_encoded["status"]) != 'descartada') {
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
        echo json_encode([
            "total_servicios" => $total_servicios,
            "pending_documents" => $pending_documents,
            "pending_citas" => $pending_citas,
            "review_documents" => $review_documents,
            "ofertas_recibidas" => $ofertas_recibidas,
            "num_usuarios" => count($users_of_admin)
        ]);
    }


}

if ($_GET['action'] == 'read-servicio') {
    update_user_meta($_GET['user_id'], $_GET['usermeta'], 'leido');
}

if ($_GET['action'] == 'delete-servicio') {
    delete_user_meta($_GET['user_id'], $_GET['usermeta']);
}