<?php
/**
 * Template Name: page-file-upload.xhr.php
 * The template for displaying page-file-upload.xhr
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package portal_propietario
 */

require_once "self/security.php";
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );


if ($_GET['action'] == 'upload-photo-inmueble') {
    $inmueble_id = $_GET['inmueble_id'];
    $upload_overrides = array( 'test_form' => false );
    $movefile = wp_handle_upload( $_FILES['filepond'], $upload_overrides );

    if ( $movefile ) {
        $movefile['validated'] = false;

        add_post_meta($inmueble_id, 'meta-photos-inmueble', $movefile);
        echo json_encode($movefile);
    }
}

if ($_GET['action'] == 'remove-photo-inmueble') {
    $inmueble_id = $_GET['inmueble_id'];
    $photo_url = $_GET['photo_url'];

    $photos = get_post_meta($inmueble_id, 'meta-photos-inmueble');

    foreach ($photos as $key => $photo) {
        if ($photo['url'] === $photo_url) {
            delete_post_meta( $inmueble_id, 'meta-photos-inmueble', $photo );
            echo 'ok';
        }
    }
}
