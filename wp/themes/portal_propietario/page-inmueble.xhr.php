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
