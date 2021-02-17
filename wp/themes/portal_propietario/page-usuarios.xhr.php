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
