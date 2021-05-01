<?php
/**
 * Template Name: page-inmueble.xhr.php
 * The template for displaying page-inmueble.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */
require_once "self/security.php";
if ($_GET['action'] == 'update_metadata') {
    $inmueble_id = $_GET['inmueble_id'];
    $user_id = $_GET['user_id'];

    
    if (strpos($key, 'inmueble-owner') === 0) {
        update_user_meta($user_id, 'meta-' . $_POST['metaname'], wp_slash($_POST['metavalue']));
    } else {
        update_post_meta($inmueble_id, 'meta-' . $_POST['metaname'], wp_slash($_POST['metavalue']));
    }
}

if ($_GET['action'] == 'inmuebles_of_user') {
    require_once "self/users-stuff.php";
    $user_id = $_GET['user_id'];

    $ret = [];
    $inmuebles = getInmueblesOfUserID($user_id);
    foreach ($inmuebles as $key => $inmueble) {
        $ret[] = [
            "id" => $inmueble->ID,
            "name" => get_post_meta($inmueble->ID, 'meta-inmueble-direccion', true) . ' ' . get_post_meta($inmueble->ID, 'meta-inmueble-poblacion', true)
        ];
    }


    echo json_encode($ret);
}
if ($_GET['action'] == 'elimina-oferta') {
    $inmueble_id = $_GET['inmueble_id'];
    $oferta_id = $_GET['oferta_id'];

    foreach (get_post_meta($inmueble_id, 'meta-oferta-al-cliente') as $old_meta_encoded) {

        $meta = json_decode(wp_unslash(($old_meta_encoded)), true);
        if ($meta["id"] == $oferta_id) {
            delete_post_meta($inmueble_id, 'meta-oferta-al-cliente', wp_slash($old_meta_encoded));

        }
    }

}
if ($_GET['action'] == 'elimina-inmueble') {
    $inmueble_id = $_GET['inmueble_id'];
    
    wp_delete_post($inmueble_id);

}
if ($_GET['action'] == 'actualiza-imagenes') {
    $inmueble_id = $_GET['inmueble_id'];
    
    delete_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo');
    update_post_meta($inmueble_id, 'meta-inmueble-imagenes-metainfo', wp_slash($_POST['metavalue']));

}
